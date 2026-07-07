// resources/js/types.ts
export type TicketStatus = 'in_afwachting' | 'in_behandeling' | 'afgehandeld';
export type UserRole = 'admin' | 'user';

export interface User {
    id: number;
    name: string;
    role: UserRole;
    // admin only shape
    first_name?: string;
    last_name?: string;
    email?: string;
    phone?: string | null;
}

export interface Category {
    id: number;
    name: string;
}

export interface TicketComment {
    id: number;
    user: User;
    message: string;
    edited_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Note {
    id: number;
    user: User;
    note: string;
    created_at: string;
    updated_at: string;
}

export interface Ticket {
    id: number;
    title: string;
    description: string;
    status: TicketStatus;
    creator: User;
    assignee: User | null;
    categories: Category[];
    comments?: TicketComment[];
    notes?: Note[];
    created_at: string;
    updated_at: string;
}
