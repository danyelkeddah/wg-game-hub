import { reactive } from 'vue';

export default class Model {
    constructor(attributes = {}) {
        Object.assign(this, reactive(attributes));
    }
}
