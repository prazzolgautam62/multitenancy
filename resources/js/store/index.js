import { createPinia } from 'pinia';
import { useUserStore } from './user';

export const pinia = createPinia();

export function useStores() {
  return {
    userStore: useUserStore(pinia),
  };
}
