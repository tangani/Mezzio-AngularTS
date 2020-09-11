import { Component, OnInit } from '@angular/core';

import { MatDialog, MatDialogRef } from "@angular/material/dialog";

@Component({
  selector: 'app-edit-project',
  templateUrl: './edit-project.component.html',
  styleUrls: ['./edit-project.component.scss']
})
export class EditProjectComponent implements OnInit {

  user = {username: '', password: '', remember: false};

  constructor(public dialogRef: MatDialogRef<EditProjectComponent>) { }

  ngOnInit(): void {
  }

  onSubmit() {
    this.dialogRef.close();
  }

}
