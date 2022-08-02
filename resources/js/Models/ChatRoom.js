import Model from '@/Models/Model';

export default class ChatRoom extends Model {
    isMainChannel() {
        return this.type === 30;
    }
}
