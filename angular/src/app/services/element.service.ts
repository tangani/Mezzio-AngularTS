import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ElementService {

  constructor(private http: HttpClient) {  }

  /** GET elements from the server */

  public getElements() {
    return this.http.get(`http://127.0.0.1:8080/elements/`);
  }
}
