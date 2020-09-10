import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from "@angular/material/dialog";
import { FormBuilder, FormGroup, Validators} from "@angular/forms";
import { AuthenticateService } from "../services/authenticate.service";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.sass']
})
export class RegisterComponent implements OnInit {

  user = {name: '', surname: '', username: '', password: '', telephoneNumber: '', email: '', contactMe: false};
  registerForm: FormGroup;
  signUpResponse;
  details;
  badResponse = null;

  constructor(
    private authenticateService: AuthenticateService,
    private formBuilder: FormBuilder,
    private dialogRef: MatDialogRef<RegisterComponent>
  ) {
    this.registerForm = this.formBuilder.group({
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
    this.dialogRef.close();
  }

}
