import { Component, OnInit } from '@angular/core';

import { Product } from '../shared/product';
import { PRODUCTS } from '../shared/products';

@Component({
  selector: 'app-valarcci',
  templateUrl: './valarcci.component.html',
  styleUrls: ['./valarcci.component.scss']
})
export class ValarcciComponent implements OnInit {

  products: Product[] = PRODUCTS;
  selectedProduct: Product;

  constructor() { }

  ngOnInit(): void {
  }

  onSelect(product: Product) {
    this.selectedProduct = product;
  }

}
