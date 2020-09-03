import { Component, OnInit } from '@angular/core';

import { AbstractControl, FormArray, FormBuilder, FormGroup } from '@angular/forms';
import { BehaviorSubject } from 'rxjs';

import { TableData } from "../shared/table-data.model";

interface Level {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-testing',
  templateUrl: './testing.component.html',
  styleUrls: ['./testing.component.scss']
})
export class TestingComponent implements OnInit {

  level: Level;
  status: Level[] = [
    {value: 'Imminent', viewValue: 'Imminent'},
    {value: 'Incomplete', viewValue: 'Incomplete'},
    {value: 'Abandoned', viewValue: 'Abandoned'},
    {value: 'Complete', viewValue: 'Complete'}
  ];

  data: TableData[] = [ { title: new String(), manager: new String(), status: String(), start: new String(), end: new String()}];
  dataSource = new BehaviorSubject<AbstractControl[]>([]);
  displayColumns = ['title', 'manager', 'status', 'start', 'end'];
  rows: FormArray = this.fb.array([]);
  form: FormGroup = this.fb.group({'dates': this.rows});


  constructor(private fb: FormBuilder) { }

  ngOnInit(): void {
    this.data.forEach((d: TableData) => this.addRow(d, false));
    this.updateView();
  }

  emptyTable() {
    while (this.rows.length >= 1) {
      this.rows.removeAt(0);
    }
  }

  addRow(d?: TableData, noUpdate?: boolean){
    const row = this.fb.group({
      'title'   : [d && d.title   ? d.title   : null, []],
      'manager' : [d && d.manager ? d.manager : null, []],
      'status'  : [d && d.status  ? d.status  : null, []],
      'start'   : [d && d.start   ? d.start   : null, []],
      'end'     : [d && d.end     ? d.end     : null, []]

    })
    this.rows.push(row);
    if (!noUpdate) { this.updateView();}
  }

  updateView(){
    this.dataSource.next(this.rows.controls);
  }

}
