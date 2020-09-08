import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class ViewService {

  constructor( private http: HttpClient ) { }

  public getProjects() {
    return this.http.get(`http://localhost:8080/projects/?page=1`);
  }

}
