import { AxiosError } from 'axios';

export function firstValidationMessage(err: unknown): string | undefined {
    if (err instanceof AxiosError) {
        const errors = err.response?.data?.errors as Record<string, string[]> | undefined;
        return errors && Object.values(errors)[0]?.[0];
    }
    return undefined;
}
