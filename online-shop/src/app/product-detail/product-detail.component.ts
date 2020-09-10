import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { Router } from "@angular/router";

import { ProductsService } from "../services/products.service";

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.sass']
})
export class ProductDetailComponent implements OnInit, OnDestroy {

  id: number;
  private sub: any;
  public href: string = "";
  dataSource;
  productCapture;

  constructor(
    private activatedRoute: ActivatedRoute,
    private router: Router,
    private productsService: ProductsService
  ) { }

  ngOnInit(): void {
    this.sub = this.activatedRoute.paramMap.subscribe(params => {
      this.id = params["id"];
    })
    this.href = this.router.url;
    let matches = this.href.match(/(\d+)/);
    console.log(this.router.url, matches[0]);
    this.productsService.getProduct(matches[0]).subscribe((product) => {
      this.productCapture = product;
      if (this.productCapture) { this.dataSource = this.productCapture; }
    })
  }

  ngOnDestroy() {
    this.sub.unsubscribe();
  }

}
