import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

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
import { MatExpansionModule } from '@angular/material/expansion';
import { MatIconModule } from '@angular/material/icon';
import { MatMenuModule } from '@angular/material/menu';
import { MatAutocompleteModule } from '@angular/material/autocomplete';
import { OverlayModule } from "@angular/cdk/overlay";

import { CdkTableModule } from '@angular/cdk/table';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HeaderComponent } from './header/header.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { OrdersComponent } from './orders/orders.component';
import { AccountComponent } from './account/account.component';
import { CartComponent } from './cart/cart.component';
import {FlexModule} from "@angular/flex-layout";
import { ProductDetailComponent } from './product-detail/product-detail.component';
import { WishListComponent } from './wish-list/wish-list.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    HeaderComponent,
    LoginComponent,
    RegisterComponent,
    OrdersComponent,
    AccountComponent,
    CartComponent,
    ProductDetailComponent,
    WishListComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    BrowserAnimationsModule,
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
    MatSortModule,
    MatTableModule,
    MatToolbarModule,
    FlexModule,
    MatExpansionModule,
    MatIconModule,
    MatMenuModule,
    MatAutocompleteModule,
    OverlayModule
  ],
  providers: [],
  bootstrap: [AppComponent],
  exports: [ MatTableModule,
    MatToolbarModule
  ]
})
export class AppModule { }
