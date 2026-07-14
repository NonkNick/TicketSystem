import {Ticket} from "@/types";
import {storeModuleFactory} from "@/stores/storeModuleFactory";

export const useTicketStore = storeModuleFactory<Ticket>('tickets')