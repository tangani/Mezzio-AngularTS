import { Component, OnInit } from '@angular/core';

import { MatDialog, MatDialogRef } from "@angular/material/dialog";
import { Details, ContactType } from "../shared/details";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import {Router} from "@angular/router"
import { LoginService } from "../services/login.service";

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.scss']
})
export class SignupComponent implements OnInit {

  user = {name: '', surname: '', username: '', password: '', telephoneNumber: '', email: '', contactMe: false};
  signUpForm: FormGroup;
  signUpResponse;
  details;
  badResponse = null;

  constructor(
    private router: Router,
    public dialogRef: MatDialogRef<SignupComponent>,
    private loginService: LoginService,
    private readonly formBuilder: FormBuilder
  ) {
    this.signUpForm = this.formBuilder.group({
      'name'       : ['', Validators.required],
      'surname'         : ['', Validators.required],
      'username'        : ['', Validators.required],
      'password'        : ['', Validators.required],
      'telephoneNumber' : ['', Validators.required],
      'email'           : ['', [Validators.required, Validators.email]],
      'contactMe'       : [false]
    })
  }

  ngOnInit(): void {
  }

  onSubmit() {
    // console.log(this.signUpForm.value);


    this.loginService.submitSignUp(this.signUpForm.value).subscribe((details) => {
      this.signUpResponse = details;
    });
    console.log(this.signUpResponse);

    if (this.signUpResponse == "Tangani: username already taken"){
        this.badResponse = 1;
    }


    // this.signUpResponse =  this.loginService.submitSignUp(this.signUpForm.value);
    // console.log(this.signUpResponse);
  }
}
