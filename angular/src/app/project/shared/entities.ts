import { Datetime } from "./datetime";

export interface Entities {
  id: number;
  title: string;
  manager: string;
  status: string;
  start: Datetime[];
  end: Datetime[];
}
