import { Component, OnInit, ViewChild } from '@angular/core';
import { MatTableDataSource } from "@angular/material/table";
import { SelectionModel, DataSource } from "@angular/cdk/collections";
import {of, Observable, BehaviorSubject} from "rxjs";
import { delay } from "rxjs/operators";
import {AbstractControl, FormGroup} from "@angular/forms";

import { ELEMENT_DATA } from "../shared/element_data";

@Component({
  selector: 'app-dynamic-table',
  templateUrl: './dynamic-table.component.html',
  styleUrls: ['./dynamic-table.component.scss']
})
export class DynamicTableComponent implements OnInit {

  feedbackForm: FormGroup;
  // dataSource = new BehaviorSubject<AbstractControl[]>([]);
  dataCapture;
  elements: [];
  editList;
  comparingCount = 0;
  dataObjectSize = 0;


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
