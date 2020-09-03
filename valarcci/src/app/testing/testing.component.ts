import { Component, OnInit } from '@angular/core';

import { AbstractControl, FormArray, FormBuilder, FormGroup } from '@angular/forms';
import { BehaviorSubject } from 'rxjs';

import { TableData } from "../shared/table-data.model";
import { Project } from "../shared/project";
import { PROJECTS} from "../shared/projects";

interface Level {
  value: string;
  viewValue: string;
}

interface Dates {
  date: string;
  timezone_type: number;
  timezone: string;
}

@Component({
  selector: 'app-testing',
  templateUrl: './testing.component.html',
  styleUrls: ['./testing.component.scss']
})
export class TestingComponent implements OnInit {

  projectData: Project[] = PROJECTS;
  object;
  objectLength = 0;

  level: Level;
  status: Level[] = [
    {value: 'Imminent', viewValue: 'Imminent'},
    {value: 'Incomplete', viewValue: 'Incomplete'},
    {value: 'Abandoned', viewValue: 'Abandoned'},
    {value: 'Complete', viewValue: 'Complete'}
  ];

  project: TableData[] = [ { title: new String(), manager: new String(), status: new String(), start: new Array<3>(), end: new Array(3) }];
  dataSource = new BehaviorSubject<AbstractControl[]>([]);
  displayColumns = ['title', 'manager', 'status', 'start', 'end'];
  rows: FormArray = this.fb.array([]);
  form: FormGroup = this.fb.group({'projects': this.rows});


  constructor(private fb: FormBuilder) { }

  ngOnInit(): void {
    while (this.objectLength < this.projectData.length){
      this.project.forEach((d: TableData) => this.addRow(this.projectData[this.objectLength], false));
      this.objectLength += 1;
    }
    // this.project.forEach((d: TableData) => this.addRow(this.projectData[0], false));
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
      'start'   : [d && d.start   ? d.start.date.substring(0,10)   : null, []],
      'end'     : [d && d.end     ? d.end.date.substring(0,10)     : null, []]

    })

    /*
    for (this.object in this.projectData){
    }
     */
    this.rows.push(row);
    if (!noUpdate) { this.updateView();}
  }

  updateView(){
    this.dataSource.next(this.rows.controls);
  }

  onSubmit(f) {
    console.log(f.value);
    // this.feedback = this.feedbackForm.value;
    //console.log(this.feedback.title);
    // this.form.reset();
    // this.feedbackFormDirective.resetForm(); 			// Make form is restored to pristine value
  }

}
