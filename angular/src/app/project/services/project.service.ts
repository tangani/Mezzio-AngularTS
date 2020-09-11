import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class ProjectService {

  constructor( private  http: HttpClient ) { }

  public updateProjects(data) {
    let count: number = 1;
    while (count <= data.length)
    {
      let current: number = +data[count - 1]['id'];
      current+=1;
      const url = "http://localhost:8080/projectsUpdate/" + current;
      console.log(url);
      let holdData = [];
      holdData.push({
        "Projects": data[count -1]
      });
      let final = [];
      final.push({
        "Request": holdData[0]
      })
      let finalStringData = JSON.stringify(final[0])
      let finalData = JSON.parse(finalStringData);
      console.log(finalData);
      count += 1;

      this.http.post<any>(url, finalData).subscribe((res) => console.log(res));
    }

    return data.length;
  }

}
