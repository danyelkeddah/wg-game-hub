import User from '@/Models/User';
import { Inertia } from '@inertiajs/inertia';

export function useCurrentUser() {
    return Inertia.page.props.auth.user
        ? new User(Inertia.page.props.auth.user)
        : false;
}
