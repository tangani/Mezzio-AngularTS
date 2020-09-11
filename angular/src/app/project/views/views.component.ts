import { Component, OnInit, ViewChild } from '@angular/core';

import { AbstractControl, FormArray, FormBuilder, FormGroup } from '@angular/forms';
import { BehaviorSubject } from 'rxjs';

import { TableData } from "../shared/table-data.model";
import { Project } from "../shared/project";
import { PROJECTS} from "../shared/projects";

import { ViewsService } from "../services/views.service";
import { ProjectService } from "../services/project.service";

interface Level {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-views',
  templateUrl: './views.component.html',
  styleUrls: ['./views.component.scss']
})
export class ViewsComponent implements OnInit {

  modifyHandle;
  feedbackForm: FormGroup;
  dataSource = new BehaviorSubject<AbstractControl[]>([]);
  dataCapture;
  projects: [];
  editList;
  comparingCount = 0;
  updateProject;

  dataObjectSize = 0;

  status: Level[] = [
    {value: 'Imminent', viewValue: 'Imminent'},
    {value: 'Incomplete', viewValue: 'Incomplete'},
    {value: 'Abandoned', viewValue: 'Abandoned'},
    {value: 'Complete', viewValue: 'Complete'}
  ];
  project: TableData[] = [ { title: new String(), manager: new String(), status: new String(), start: new Array<3>(), end: new Array(3) }];
  displayColumns = ['title', 'manager', 'status', 'start', 'end'];

  rows: FormArray = this.formBuilder.array([]);
  form: FormGroup = this.formBuilder.group({'projects': this.rows});

  constructor(
    private formBuilder: FormBuilder ,
    private viewsService: ViewsService,
    private projectService: ProjectService
    ) {  }

  ngOnInit(): void {

    this.viewsService.getProjects().subscribe((projects) => {
      this.dataCapture = projects;
      // console.log("Combination: ", typeof this.dataCapture);
      // console.log("Combination: ", this.dataCapture);
      // this.dataControl();
      if (this.dataCapture) {
        this.dataObjectSize = 0;
        const end = this.dataCapture.length;
        // console.log(end);
        while (this.dataObjectSize < end) {
          console.log(this.dataCapture[this.dataObjectSize]);
          this.project.forEach((pr: TableData) => this.addRow(this.dataCapture[this.dataObjectSize], false));
          this.dataObjectSize += 1;
        }
      }
    })

  }

  emptyTable() {
    while (this.rows.length >= 1) {
      this.rows.removeAt(0);
    }
  }

  addRow(entry?: TableData, noUpdate?: boolean) {
    const row = this.formBuilder.group({
      'title'  :  [entry && entry.title   ? entry.title                           : null, []],
      'manager':  [entry && entry.manager ? entry.manager                         : null, []],
      'status' :  [entry && entry.status  ? entry.status                          : null, []],
      'start'  :  [entry && entry.start   ? entry.start["date"].substring(0,10)   : null, []],
      'end'    :  [entry && entry.end     ? entry.end["date"].substring(0,10)     : null, []]
    })
    this.rows.push(row);
    if(!noUpdate) { this.updateView(); }
  }

  updateView(){
    this.dataSource.next(this.rows.controls);
  }

  onSubmit(f) {
    let entry;
    this.editList = [];
    this.comparingCount = 0;
    while (this.comparingCount < this.dataCapture.length) {
      if (f.value["projects"][this.comparingCount]["title"] !== this.dataCapture[this.comparingCount]["title"]) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["manager"] !== this.dataCapture[this.comparingCount]["manager"]) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["status"] !== this.dataCapture[this.comparingCount]["status"]) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["start"] !== this.dataCapture[this.comparingCount]["start"].date.substring(0,10)) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      if (f.value["projects"][this.comparingCount]["end"] !== this.dataCapture[this.comparingCount]["end"].date.substring(0,10)) {
        // console.log(f.value["projects"][this.comparingCount]);
        this.editList.push(this.comparingCount)
      }
      this.comparingCount += 1;
    }
    // console.log(this.editList);
    // console.log(f.value["projects"][this.editList[0]]);


    console.log(this.editList);
    const uniqueList = new Set(this.editList);
    this.editList = [...uniqueList];
    console.log(this.editList);

    // this.modifyHandle = [{id: this.comparingCount[0], ...f.value["projects"][this.editList[0]]}];
    this.modifyHandle = [];

    let count = 0;
    while (count < this.editList.length) {
      this.modifyHandle.push({id: this.editList[count], ...f.value["projects"][this.editList[count]]});
      count += 1;
    }


    console.log(this.modifyHandle);
    this.updateProject = this.projectService.updateProjects(this.modifyHandle);
    console.log(this.updateProject);
  }

}
