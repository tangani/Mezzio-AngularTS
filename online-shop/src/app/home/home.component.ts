import { Component, OnInit } from '@angular/core';

import { ProductsService } from "../services/products.service";
import {FormBuilder} from "@angular/forms";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.sass']
})
export class HomeComponent implements OnInit {

  productCapture;
  dataSource;

  constructor(
    private productsService: ProductsService,
    private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.productsService.getProducts().subscribe((products) => {
      this.productCapture = products;
      if (this.productCapture) { this.dataSource = this.productCapture}
    })
  }

}
