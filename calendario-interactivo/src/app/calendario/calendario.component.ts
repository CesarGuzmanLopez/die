import { CommonModule } from '@angular/common';
import { HttpClient } from '@angular/common/http'; // Import HttpClientModule
import { Component } from '@angular/core';
import { isWithinInterval } from 'date-fns'; // Import date-fns functions
import { Observable } from 'rxjs';

interface SymbolInfo {
  day: number;
  month: number;
  year: number;
  className: string;
  text?: string;
}

interface WeekInfo {
  startDay: number;
  startMonth: number;
  startYear: number;
  name: string;
}

interface CalendarDay {
  dayNumber: number;
  symbol?: SymbolInfo;
  className: string;
  date: Date;
  type: 'day' | 'numberofweek' | 'other';
}
interface Trimestre {
  nombre: string;
  inicio: string;
}

interface CalendarData {
  days: SymbolInfo[];
  weeks: WeekInfo[];
  trimestres: Trimestre[];
}

@Component({
  selector: 'app-calendario',
  standalone: true,
  imports: [CommonModule], // Add HttpClientModule here
  templateUrl: './calendario.component.html',
  styleUrls: ['./calendario.component.scss'],
})
export class CalendarioComponent {
  days: CalendarDay[] = [];
  firstDayOfWeek: number = 0;
  titulo: string = 'Calendario';
  trimestreActual: string = '';
  editMode: boolean = false;
  editingIndex: number | null = null;
  symbolInfo: SymbolInfo[] = [];
  weekInfo: WeekInfo[] = [];
  trimestres: Trimestre[] = [];
  currentWeekStart: number = -2;

  constructor(private readonly http: HttpClient) {
    this.loadCalendarData().subscribe((data) => {
      this.symbolInfo = data.days;
      this.weekInfo = data.weeks;
      this.trimestres = data.trimestres;
      console.log(data);
      this.generarCalendario(this.currentWeekStart);
      this.setCurrentTrimester(this.trimestres);
    });
  }

  setCurrentTrimester(trimestres: Trimestre[]) {
    const today = new Date();
    for (const trimester of trimestres) {
      const inicio = new Date(trimester.inicio);
      console.log(inicio);
      if (
        isWithinInterval(today, {
          start: inicio,
          end: new Date(inicio).setMonth(inicio.getMonth() + 5),
        })
      ) {
        this.trimestreActual = trimester.nombre;
      }
    }
  }

  loadCalendarData(): Observable<CalendarData> {
    const baseHref =
      document.querySelector('base')?.getAttribute('href') ?? '/';
    return this.http.get<CalendarData>(`${baseHref}assets/info.json`);
  }

  getStartOfWeek(date: Date): Date {
    const day = date.getDay();
    const diff = date.getDate() - day + (day === 0 ? -6 : 1);
    const newDate = new Date(date);
    newDate.setDate(diff);
    return newDate;
  }

  prevWeek() {
    if (this.currentWeekStart < -60) {
      return;
    }
    this.currentWeekStart -= 1;
    this.generarCalendario(this.currentWeekStart);
  }

  nextWeek() {
    if (this.currentWeekStart > 60) {
      return;
    }
    this.currentWeekStart += 1;
    this.generarCalendario(this.currentWeekStart);
  }

  generarCalendario(semanasRelativas: number) {
    this.days = []; // Clear the days array before generating the new calendar
    const meses = [
      'Enero',
      'Febrero',
      'Marzo',
      'Abril',
      'Mayo',
      'Junio',
      'Julio',
      'Agosto',
      'Septiembre',
      'Octubre',
      'Noviembre',
      'Diciembre',
    ];
    const hoy = new Date();

    const lunesActual = this.getStartOfWeek(hoy);

    let fechaActual = new Date(lunesActual);

    fechaActual.setDate(fechaActual.getDate() + semanasRelativas * 7);
    const lunesInicio = new Date(fechaActual);

    for (let semana = 0; semana < 5; semana++) {
      this.days.push({
        dayNumber: NaN,
        date: new Date(fechaActual),
        className: 'dia-semana',
        type: 'numberofweek',
        symbol: {
          day: fechaActual.getDate(),
          month: fechaActual.getMonth() + 1,
          year: fechaActual.getFullYear(),
          className: 'semana',
          text: `-`,
        },
      });
      for (let dia = 0; dia < 7; dia++) {
        const isActualweek: boolean = isWithinInterval(fechaActual, {
          start: lunesActual,
          end: new Date(lunesActual).setDate(lunesActual.getDate() + 6),
        });

        this.days.push({
          dayNumber: fechaActual.getDate(),
          date: new Date(fechaActual),
          className: isActualweek ? 'semana-actual' : '',
          type: 'day',
        });
        fechaActual.setDate(fechaActual.getDate() + 1);
      }
    }
    this.days.forEach((day, index) => {
      if (
        day.dayNumber === hoy.getDate() &&
        day.date.getMonth() === hoy.getMonth() &&
        day.date.getFullYear() === hoy.getFullYear()
      ) {
        day.className += ' dia-actual';
      }
      if (isNaN(day.dayNumber)) {
        const week = this.weekInfo.find(
          (info) =>
            info.startDay === day.date.getDate() &&
            info.startMonth === day.date.getMonth() + 1 &&
            info.startYear === day.date.getFullYear(),
        );
        if (week) {
          if (day.symbol) {
            day.symbol.text = week.name;
          }
        }
      }

      const symbol = this.symbolInfo.find((info) => {
        return (
          info.day === day.dayNumber &&
          info.month === day.date.getMonth() + 1 &&
          info.year === day.date.getFullYear()
        );
      });
      if (symbol) {
        day.symbol = symbol;
        day.className += ` ${symbol.className}`;
      }
    });

    const mesInicio = meses[lunesInicio.getMonth()];
    const mesFin = meses[fechaActual.getMonth()];
    const yearInicio = lunesInicio.getFullYear();
    const yearfinal = fechaActual.getFullYear();
    if (yearInicio === yearfinal) {
      this.titulo = `${mesInicio} - ${mesFin} ${yearInicio}`;
    } else {
      this.titulo = `${mesInicio} ${yearInicio} - ${mesFin} ${yearfinal} `;
    }
  }
}
