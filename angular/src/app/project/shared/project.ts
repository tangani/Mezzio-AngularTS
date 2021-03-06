interface Dates {
  date: string;
  timezone_type: number;
  timezone: string;
}


export class Project {
  id: number;
  title: string;
  manager: string;
  status: string;
  start: Dates;
  end: Dates;
}
