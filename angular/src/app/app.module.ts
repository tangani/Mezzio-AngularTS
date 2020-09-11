import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';

import { AppRoutingModule } from './app-routing/app-routing.module';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FlexLayoutModule } from "@angular/flex-layout";
import { CdkTableModule } from '@angular/cdk/table';

import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { MatToolbarModule } from "@angular/material/toolbar";
import { MatTableModule } from "@angular/material/table";
import { HttpClientModule } from '@angular/common/http';
import { MatCardModule } from '@angular/material/card';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatSelectModule } from '@angular/material/select';
import { MatButtonModule } from '@angular/material/button';
import { MatInputModule } from '@angular/material/input';
import { MatDialogModule } from '@angular/material/dialog';
import { MatCheckboxModule } from "@angular/material/checkbox";
import { MatSlideToggleModule } from "@angular/material/slide-toggle";
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatPaginatorModule } from "@angular/material/paginator";
import { MatProgressSpinnerModule } from "@angular/material/progress-spinner";
import { MatSortModule } from "@angular/material/sort";


import { MaterialElevationDirective } from './material-elevation.directive';


import 'hammerjs';

import { ElementsComponent } from './elements/elements.component';
import { LoginComponent } from './project/login/login.component';
import { HeaderComponent } from './project/header/header.component';
import { HomeComponent } from './project/home/home.component';
import { SignupComponent } from './project/signup/signup.component';
import { ViewsComponent } from './project/views/views.component';
import { EditProjectComponent } from './project/edit-project/edit-project.component';
import { ValarcciComponent } from './project/valarcci/valarcci.component';
// import { ProjectEditComponent } from "./project/views/views.component";

@NgModule({
  declarations: [
    AppComponent,
    ElementsComponent,
    LoginComponent,
    HeaderComponent,
    HomeComponent,
    SignupComponent,
    ViewsComponent,
    EditProjectComponent,
    ValarcciComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatToolbarModule,
    FlexLayoutModule,
    MatTableModule,
    HttpClientModule,
    CdkTableModule,
    MatCardModule,
    MatFormFieldModule,
    MatSelectModule,
    MatButtonModule,
    MatInputModule,
    MatDialogModule,
    ReactiveFormsModule,
    MatCheckboxModule,
    FormsModule,
    MatSlideToggleModule,
    MatDatepickerModule,
    MatButtonModule,
    MatPaginatorModule,
    MatProgressSpinnerModule,
    MatSortModule
  ],
  providers: [],
  bootstrap: [AppComponent],
  exports: [ MatTableModule,
    MatToolbarModule
  ],
  entryComponents: [
    LoginComponent
  ]
})
export class AppModule { }
