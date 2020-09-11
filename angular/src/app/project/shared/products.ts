import { Product } from './product';

export const PRODUCTS: Product[] = [
  {
    id: '0',
    name: 'Consulting Electrical Engineers',
    image: '/assets/images/american-public.jpg',
    category: 'service',
    featured: true,
    label: 'hot',
    deliverable: ['Reticulation and transmission', 'Electrical design solutions'],
    description: 'First of his name, mater of skills and shenanigans'
  },
  {
    id: '1',
    name: 'Consulting Electronic Engineers',
    image: '/assets/images/power-lines.jpg',
    category: 'service',
    featured: true,
    label: 'hot',
    deliverable: ['Fire detection', 'Emergency evacuation'],
    description: 'First of his name, mater of skills and shenanigans'
  },
  {
    id: '2',
    name: 'Consulting Mechanical Engineers',
    image: '/assets/images/marius.jpg',
    category: 'service',
    featured: true,
    label: 'hot',
    deliverable: ['HVAC design', 'Centralized heating'],
    description: 'First of his name, mater of skills and shenanigans'
  }

]
