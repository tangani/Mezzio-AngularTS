import { Injectable } from '@angular/core';

import { HttpClient ,  HttpHeaders} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  url: string;

  constructor(private http: HttpClient) {
  }

  public submitLogin(details)
  {
    // this.url = `http://localhost:8080/login/Nono/e583799b852467HWeirdWords7f0cb11ca3c3`
    // this.url = `http://localhost:8080/login/Tangani/891234SomewhereElse`
    this.url = `http://localhost:8080/login/` + details.username + "/" + details.password;

    console.log("Final URL:", this.url);
    return this.http.get(this.url);
  }

  public submitSignUp(details)
  {

    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type':  'application/json'
      })
    };

    let holdData = [];
    holdData.push({
      "SignUp": details
    });
    let final = [];
    final.push({
      "Request": holdData[0]
    })

    let finalStringData =  JSON.stringify(final[0]);
    let finalData = JSON.parse(finalStringData);

    console.log("Details: ", finalData);
    this.url = `http://localhost:8080/signup/`;
    return this.http.post<any>(this.url, finalData); //.subscribe((res) => console.log(res));
    // return details;
  }
}
