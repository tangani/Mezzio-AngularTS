import { Component, OnInit } from '@angular/core';
import { animate, state, style, transition, trigger } from "@angular/animations";

import { PeriodicElement } from '../shared/element';
import { ElementService } from "../services/element.service";

@Component({
  selector: 'app-elements',
  templateUrl: './elements.component.html',
  styleUrls: ['./elements.component.scss'],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
})
export class ElementsComponent implements OnInit {

  dataSource;
  elements;
  selectedElement: PeriodicElement;

  columnsToDisplay = ['name', 'weight', 'symbol', 'position'];
  expandedElement: PeriodicElement | null;

  constructor(private elementService: ElementService) {  }

    ngOnInit() {
    this.elementService.getElements().subscribe((elements) => {
      console.log(elements);
      this.dataSource = elements;
    });
  }

}
