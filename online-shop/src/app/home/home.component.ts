import { Component, OnInit } from '@angular/core';

import { ProductsService } from "../services/products.service";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.sass']
})
export class HomeComponent implements OnInit {

  productCapture;

  constructor(
    private productsService: ProductsService
  ) { }

  ngOnInit(): void {
    /*
    this.productsService.getProducts().subscribe((products) => {
      this.productCapture = products;
    })
     */
  }

}
