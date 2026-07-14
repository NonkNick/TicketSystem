import type { Category } from '@/types';
import { storeModuleFactory } from '@/stores/storeModuleFactory';

export const useCategoryStore = storeModuleFactory<Category>('categories');
