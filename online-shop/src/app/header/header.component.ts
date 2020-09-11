// https://stackblitz.com/angular/gkjdbnlgddy?file=src%2Fapp%2Fautocomplete-auto-active-first-option-example.ts

import { Component, OnInit } from '@angular/core';
import { MatDialog } from "@angular/material/dialog";
import { LoginComponent } from "../login/login.component";
import { RegisterComponent } from "../register/register.component";
import { Observable } from "rxjs";
import { map, startWith } from "rxjs/operators";
import { FormControl } from "@angular/forms";



import { ProductsService } from "../services/products.service";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.sass']
})
export class HeaderComponent implements OnInit {

  dataSource;
  formControl = new FormControl();
  filterOptions: Observable<string[]>;
  options: string[];

  cartProducts = 0;
  selectedProducts;
  AddedCartProducts;

  // cartProducts = localStorage.getItem('clickCounter');
  //if (sessionStorage.getItem('clickCounter') == null) {}

  constructor(
    private dialog: MatDialog,
    private productsService: ProductsService
  ) { }

  ngOnInit(): void {
    this.productsService.getProducts().subscribe( (products) => {
      this.dataSource = products;
      if (this.dataSource)
      {
        this.options = Object.keys(products).map(function (productIndex) {
          let eachProduct = products[productIndex]["title"];
          return eachProduct;
        })
        this.filterOptions = this.formControl.valueChanges.pipe(
          startWith(''),
          map(value => this._filter(value))
        );
      }
    });
    sessionStorage.setItem('cartCounter', this.cartProducts.toString());
    this.AddedCartProducts = sessionStorage.getItem('cartCounter');
  }

  openLoginForm() {
    this.dialog.open(LoginComponent, {width: '500px', height: '450px'});
  }

  openRegisterForm() {
    this.dialog.open(RegisterComponent, {width: '500px', height: '450px'})
  }

  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.options.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }


}
