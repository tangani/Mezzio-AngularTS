import { Component, OnInit } from '@angular/core';

import { AbstractControl, FormArray, FormBuilder, FormGroup } from '@angular/forms';
import { BehaviorSubject } from 'rxjs';

import { TableData } from "../shared/table-data.model";
import { Project } from "../shared/project";
import { PROJECTS} from "../shared/projects";
import { ViewService } from "../view.service";

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

  projectData: Project[] = PROJECTS;
  object;
  objectLength = 0;
  comparingCount = 0;
  str: string;
  editList: number [];

  // level: Level;
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


  constructor(
    private fb: FormBuilder,
    private viewService: ViewService
  ) { }

  ngOnInit(): void {

    // console.log(typeof this.projectData);
    // console.log(this.projectData);

    while (this.objectLength < this.projectData.length){
      // @ts-ignore
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
      // @ts-ignore
      'start'   : [d && d.start   ? d.start.date.substring(0,10)   : null, []],
      // @ts-ignore
      'end'     : [d && d.end     ? d.end.date.substring(0,10)     : null, []]

    })


    this.rows.push(row);
    if (!noUpdate) { this.updateView();}

  }

  updateView(){
    this.dataSource.next(this.rows.controls);
  }

  onSubmit(f) {

    this.editList = [];
    this.comparingCount = 0;
    while (this.comparingCount < this.projectData.length) {
      if (f.value["projects"][this.comparingCount]["title"] !== this.projectData[this.comparingCount]["title"]) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["manager"] !== this.projectData[this.comparingCount]["manager"]) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["status"] !== this.projectData[this.comparingCount]["status"]) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["start"] !== this.projectData[this.comparingCount]["start"].date.substring(0,10)) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["end"] !== this.projectData[this.comparingCount]["end"].date.substring(0,10)) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      this.comparingCount += 1;
    }
    console.log(this.editList);
    console.log(f.value["projects"][this.editList[0]]);
  }
}
