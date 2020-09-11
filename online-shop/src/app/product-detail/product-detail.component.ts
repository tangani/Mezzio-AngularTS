import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { Router } from "@angular/router";

import { trigger, state, style, animate, transition } from '@angular/animations';

import { ProductsService } from "../services/products.service";

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.sass'],
  animations: [
    trigger('buttonTextStateTrigger', [
      state('shown', style({
        opacity: 1
      })),
      state('transitioning', style({
        opacity: 0.3
      })),
      transition('shown => transitioning', animate('600ms ease-out')),
      transition('transitioning => shown', animate('600ms ease-in'))
    ]),
  ]
})
export class ProductDetailComponent implements OnInit, OnDestroy {

  id: number;
  private sub: any;
  public href: string = "";
  dataSource;
  productCapture;

  cartProducts = 0;

  buttonTextState = 'shown';
  buttonText = 'ADD TO CART';
  transitionButtonText = 'ADD TO CART';

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

  buttonTextTransitioned(event) {
    this.buttonText = this.transitionButtonText;
    this.buttonTextState = this.buttonTextState = 'shown';
  }


  onAddToCart(id) {
    // Kick off the first transition
    this.cartProducts += 1;
    sessionStorage.setItem('cartCounter', this.cartProducts.toString());
    console.log("Added an item");

    if (id == "cart") {
      console.log(id);
      this.buttonTextState = 'transitioning';
      this.transitionButtonText = 'ADDING...';


      setTimeout(() => {
        this.buttonTextState = 'transitioning';
        this.transitionButtonText = 'ADDED';
      }, 1800);

      // Reset button text
      setTimeout(() => {
        this.buttonTextState = 'transitioning';
        this.transitionButtonText = 'ADD TO CART';
      }, 3600);
    }



  }

}
