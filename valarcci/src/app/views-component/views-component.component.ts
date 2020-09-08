import { Component, OnInit, ViewChild } from '@angular/core';
import { animate, state, style, transition, trigger } from "@angular/animations";
import { MatDialog } from "@angular/material/dialog";
import { FormBuilder, FormGroup, FormArray, NgForm, Validators, FormControl} from '@angular/forms';

import { ViewService } from "../view.service";
import { Entities } from "../shared/entities";
import { Feedback } from "../shared/feedback";

interface Level {
  value: string;
  viewValue: string;
}

@Component({
  selector: 'app-views-component',
  templateUrl: './views-component.component.html',
  styleUrls: ['./views-component.component.scss'],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ]
})
export class ViewsComponentComponent implements OnInit {

  feedbackForm: FormGroup;
  dataSource;
  projects;
  selectedElements: Entities;
  feedback:  Feedback;

  @ViewChild('fform') feedbackFormDirective;				// Reset the form to its pristine value

  status: Level[] = [
    {value: 'Imminent', viewValue: 'Imminent'},
    {value: 'Incomplete', viewValue: 'Incomplete'},
    {value: 'Abandoned', viewValue: 'Abandoned'},
    {value: 'Complete', viewValue: 'Complete'}
  ];

  columnsToDisplay: string[] = ['title', 'manager', 'status', 'start', 'end'];
  expandedRow: Entities | null;

  constructor(
    private formBuilder: FormBuilder,
    private viewService: ViewService,
    public dialog: MatDialog
  ) {  }


  ngOnInit(): void {
    this.viewService.getProjects().subscribe((projects) => {
      // if (projects) {
        this.dataSource = projects;
      // }
    })
  }


  onSubmit(f) {
    console.log(f.value);
    this.feedback = this.feedbackForm.value;
    console.log(this.feedback.title);
    // console.log(this.feedback);
    this.feedbackForm.reset();
    // this.feedbackFormDirective.resetForm(); 			// Make form is restored to pristine value
  }

}
