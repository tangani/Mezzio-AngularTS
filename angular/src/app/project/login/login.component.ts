import { Component, OnInit } from '@angular/core';

import { MatDialog, MatDialogRef } from "@angular/material/dialog";
import {FormGroup, FormControl, FormBuilder, Validators} from "@angular/forms";
import {Router} from "@angular/router"

import { LoginService } from "../services/login.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  user = {username: '', password: '', remember: false};
  loginForm: FormGroup;
  loginResponse;
  details;

  constructor(
    private router: Router,
    private loginService: LoginService,
    public dialogRef: MatDialogRef<LoginComponent>,
    private readonly fb: FormBuilder) {
    this.loginForm = this.fb.group(
      {
      username: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  ngOnInit(): void {
  }

  onSubmit() {
    // console.log(this.loginForm.getRawValue());
    // console.log("Form Submitted!");
    this.loginService.submitLogin(this.loginForm.getRawValue()).subscribe((details) => {
      this.loginResponse = details;
    });
    // console.log(this.loginResponse);
    // console.log(typeof this.loginResponse);
    sessionStorage.setItem('id_token', this.loginResponse);
    if (this.loginResponse !== undefined){
      this.dialogRef.close();
      this.router.navigate(['/project/views']).then();
    }
  }

}
