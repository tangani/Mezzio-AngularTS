import { Component, OnInit } from '@angular/core';

import { ProductsService } from "../services/products.service";
import { FormBuilder } from "@angular/forms";
import { Router } from "@angular/router";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.sass']
})
export class HomeComponent implements OnInit {

  productCapture;
  dataSource;

  name = 'Angular';

  constructor(
    private productsService: ProductsService,
    private formBuilder: FormBuilder,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.productsService.getProducts().subscribe((products) => {
      this.productCapture = products;
      if (this.productCapture) { this.dataSource = this.productCapture}
    })
  }
// Changes in my life

  select(title) {
    console.log(title);
    this.router.navigate(['product', title]);
    // this.titles.map(t=>t.isSelected = false);
    // title.isSelected = true;
    // this.titleSelected = title;
    // console.log(this.titles);
  }

}

export class title {
  name: string;
  isSelected?: boolean;
}
