import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HomeComponent } from "./home/home.component";
import { ProductDetailComponent } from "./product-detail/product-detail.component";
import { CartComponent } from "./cart/cart.component";
import { OrdersComponent} from "./orders/orders.component";
import { WishListComponent } from "./wish-list/wish-list.component";

const routes: Routes = [
  { path: 'home',        component: HomeComponent},
  { path: 'product/:id', component: ProductDetailComponent},
  { path: 'cart',        component: CartComponent},
  { path: 'orders',      component: OrdersComponent},
  { path: 'wishlist',    component: WishListComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
