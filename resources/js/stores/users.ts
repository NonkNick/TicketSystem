import type { User } from '@/types';
import { storeModuleFactory } from '@/stores/storeModuleFactory';

export const useUserStore = storeModuleFactory<User>('users');
