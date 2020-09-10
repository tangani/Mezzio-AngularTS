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

  defaultElevation = 2;
  raisedElevation = 8;

  titles:title[] = [{name:'title1'}, {name:'title2'},{name:'title3'}];
  titleSelected;

  name = 'Angular';

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


  select(title) {
    console.log(title);
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
