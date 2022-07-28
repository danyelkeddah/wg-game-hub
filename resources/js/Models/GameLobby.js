import { reactive } from 'vue';
import dayjs from 'dayjs';
import Model from '@/Models/Model';

export default class GameLobby extends Model {
    static get socketEvents() {
        return {
            chatMessage: '.chat.message',
            userJoined: '.user.joined',
            userLeft: '.user.left',
            status: {
                processingResults: '.status.processing-results',
                resultsProcessed: '.status.results-processed',
            },
        };
    }

    static get availableStatuses() {
        return {
            Scheduled: 10,
            InLobby: 20,
            InGame: 30,
            GameEnded: 40,
            ProcessingResults: 50,
            ResultsProcessed: 60,
            DistributingPrizes: 70,
            PrizesDistributed: 80,
            Archived: 90,
        };
    }

    get timeToStartAsString() {
        return this._timeToStart;
    }

    get IsProcessingResults() {
        return this.status === GameLobby.availableStatuses.ProcessingResults;
    }

    get areResultsProcessed() {
        return this.status === GameLobby.availableStatuses.ResultsProcessed;
    }

    resultsAreProccessed() {
        this.status = GameLobby.availableStatuses.ResultsProcessed;
    }

    addUser(user) {
        this.users.push(user);
    }

    removeUser(user) {
        _.remove(this.users, (userObj) => {
            return userObj.id === user.id;
        });
    }

    startCountDownTimer() {
        let scheduledAt = dayjs(this.scheduled_at_utc_string);
        this._countDownTimerInterval = setInterval(() => {
            let now = dayjs();
            let diff = dayjs.duration(scheduledAt.diff(now));
            let days = `${diff.get('days')}d`;
            let hours = `${diff.get('hours')}h`;
            let minutes = `${diff.get('minutes')}m`;
            let seconds = `${diff.get('seconds')}s`;
            this._timeToStart = `${days} ${hours} ${minutes} ${seconds}`;
        }, 1000);
    }

    killCountDownTimer() {
        clearInterval(this._countDownTimerInterval);
    }
}
