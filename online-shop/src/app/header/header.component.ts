import { Component, OnInit } from '@angular/core';
import { MatDialog } from "@angular/material/dialog";
import { LoginComponent } from "../login/login.component";
import { RegisterComponent } from "../register/register.component";

import { ProductsService } from "../services/products.service";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.sass']
})
export class HeaderComponent implements OnInit {

  dataSource;

  constructor(
    private dialog: MatDialog,
    private productsService: ProductsService
  ) { }

  ngOnInit(): void {
    this.productsService.getProducts().subscribe( (products) => {
      this.dataSource = products;
    })
  }

  openLoginForm() {
    this.dialog.open(LoginComponent, {width: '500px', height: '450px'});
  }

  openRegisterForm() {
    this.dialog.open(RegisterComponent, {width: '500px', height: '450px'})
  }

}
