import { Component, OnInit } from '@angular/core';
import { MatDialog } from "@angular/material/dialog";
import {FormBuilder, FormGroup, FormArray, AbstractControl} from '@angular/forms';
import { BehaviorSubject } from 'rxjs';

import { TableData } from "../shared/table-data.model";
import { ViewService } from "../view.service";

interface Level {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-combination',
  templateUrl: './combination.component.html',
  styleUrls: ['./combination.component.scss']
})
export class CombinationComponent implements OnInit {

  feedbackForm: FormGroup;
  dataSource = new BehaviorSubject<AbstractControl[]>([]);
  dataCapture;
  projects: [];
  editList;
  comparingCount = 0;

  dataObjectSize = 0;

  project: TableData[] = [ { title: new String(), manager: new String(), status: new String(), start: new Array<3>(), end: new Array(3) }];
  columnsToDisplay: string[] = ['title', 'manager', 'status', 'start', 'end'];

  rows: FormArray = this.formBuilder.array([]);
  form: FormGroup = this.formBuilder.group({'projects': this.rows});

  constructor(
    private formBuilder: FormBuilder,
    private viewService: ViewService,
    public dialog: MatDialog
  ) { }

  ngOnInit(): void {
    this.viewService.getProjects().subscribe((projects) => {
      this.dataCapture = projects;
      // console.log("Combination: ", typeof this.dataCapture);
      console.log("Combination: ", this.dataCapture);
      // this.dataControl();
      if (this.dataCapture) {
        this.dataObjectSize = 0;
        const end = this.dataCapture.length;
        console.log(end);
        while (this.dataObjectSize < end) {
          console.log(this.dataCapture[this.dataObjectSize]);
          this.project.forEach((pr: TableData) => this.addRow(this.dataCapture[this.dataObjectSize], false));
          this.dataObjectSize += 1;
        }
      }
    })

  }


  addRow(entry?: TableData, noUpdate?: boolean) {
    const row = this.formBuilder.group({
      'title'  :  [entry && entry.title   ? entry.title   : null, []],
      'manager':  [entry && entry.manager ? entry.manager : null, []],
      'status' :  [entry && entry.status  ? entry.status  : null, []],
      'start'  :  [entry && entry.start   ? entry.start   : null, []],
      'end'    :  [entry && entry.end     ? entry.end     : null, []]
    })
    this.rows.push(row);
    if(!noUpdate) { this.updateView(); }
  }

  emptyTable() {
    while(this.rows.length >= 1) {
      this.rows.removeAt(0);
    }
  }

  updateView() {
    this.dataSource.next(this.rows.controls);
  }

  onSubmit(f) {

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
    console.log(this.editList);
    console.log(f.value["projects"][this.editList[0]]);
  }

}
