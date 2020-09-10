import { Component, OnInit, ViewChild } from '@angular/core';
import { MatTableDataSource } from "@angular/material/table";
import { SelectionModel, DataSource } from "@angular/cdk/collections";
import { of, Observable } from "rxjs";
import { delay } from "rxjs/operators";

export interface PeriodicElements {
  name:     string;
  position: number;
  weight:   number;
  symbol:   string;
}

const ELEMENT_DATA: PeriodicElements[] = [
  {position: 1, name: 'Hydrogen', weight: 1.0079, symbol: 'H'},
  {position: 2, name: 'Helium', weight: 4.0026, symbol: 'He'},
  {position: 3, name: 'Lithium', weight: 6.941, symbol: 'Li'},
  {position: 4, name: 'Beryllium', weight: 9.0122, symbol: 'Be'},
  {position: 5, name: 'Boron', weight: 10.811, symbol: 'B'},
  {position: 6, name: 'Carbon', weight: 12.0107, symbol: 'C'},
  {position: 7, name: 'Nitrogen', weight: 14.0067, symbol: 'N'},
  {position: 8, name: 'Oxygen', weight: 15.9994, symbol: 'O'},
  {position: 9, name: 'Fluorine', weight: 18.9984, symbol: 'F'},
  {position: 10, name: 'Neon', weight: 20.1797, symbol: 'Ne'},
]

@Component({
  selector: 'app-dynamic-table',
  templateUrl: './dynamic-table.component.html',
  styleUrls: ['./dynamic-table.component.scss']
})
export class DynamicTableComponent implements OnInit {

  editableColumn = '';
  editableIndex = null;

  displayedColumns: string[] = ['position', 'name', 'weight', 'symbol'];
  dataSource = ELEMENT_DATA;

  edit(index: number, column: string) {
    this.editableColumn = column;
    this.editableIndex = index;
  }

  showInput(index: number, column: string) {
    return this.editableColumn === column && this.editableIndex === index;
  }

  showValue(index: number, column: string) {
    return this.editableColumn !== column || this.editableIndex !== index;
  }

  constructor() { }

  ngOnInit(): void {
  }

}
