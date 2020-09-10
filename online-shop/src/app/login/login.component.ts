import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from "@angular/material/dialog";
import { FormGroup, FormBuilder, Validators } from "@angular/forms";

import { AuthenticateService } from "../services/authenticate.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.sass']
})
export class LoginComponent implements OnInit {

  user = {username: '', password: '', remember: false};
  loginForm: FormGroup;
  loginResponse;

  constructor(
    private authenticateService: AuthenticateService,
    private dialogRef: MatDialogRef<LoginComponent>,
    private formBuilder: FormBuilder
  ) {
    this.loginForm = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required],
      remember: ['']
    });
  }

  ngOnInit(): void {
  }

  onSubmit() {
    this.dialogRef.close();
  }

}
