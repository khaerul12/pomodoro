<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Pomodoro Sessions</h1>
        <form action="/pomodoro" method="POST" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="number" name="duration" class="form-control" placeholder="Duration in minutes" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Add Session</button>
                </div>
            </div>
        </form>

        <h2>Sessions</h2>
        <ul class="list-group mb-3" id="session-list">
            @foreach ($sessions as $session)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $session->duration }} minutes
                    <div>
                        <!-- Added Start Button -->
                        <button class="btn btn-success start-timer" data-duration="{{ $session->duration }}">
                            Start
                        </button>
                        <form action="{{ route('pomodoro.destroy', $session) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div id="timer" class="alert alert-info" style="display: none;"></div>
        <button id="stop-timer" class="btn btn-danger" style="display: none;">Stop</button>

        <!-- Audio element for the alarm sound -->
        <audio id="alarm-sound" src="{{ asset('alarm.mp3') }}" preload="auto"></audio>
    </div>

    <script>
        let timerInterval;
        let isTimerRunning = false;

        function startTimer(duration) {
            if (isTimerRunning) {
                if (!confirm('A timer is already running. Do you want to start a new one?')) {
                    return;
                }
            }

            let time = duration * 60; // Convert minutes to seconds
            const display = document.getElementById('timer');
            display.style.display = 'block';

            clearInterval(timerInterval);
            timerInterval = setInterval(function () {
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;

                display.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (--time < 0) {
                    clearInterval(timerInterval);
                    document.getElementById('alarm-sound').play(); // Play the alarm sound
                    alert('Pomodoro session is over!');
                    display.style.display = 'none';
                    isTimerRunning = false;
                    document.getElementById('stop-timer').style.display = 'none'; // Hide stop button
                }
            }, 1000);

            isTimerRunning = true;
            document.getElementById('stop-timer').style.display = 'inline-block'; // Show stop button
        }

        function stopTimer() {
            clearInterval(timerInterval);
            document.getElementById('timer').style.display = 'none'; // Hide timer display
            isTimerRunning = false;
            document.getElementById('stop-timer').style.display = 'none'; // Hide stop button
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Start buttons functionality
            const startButtons = document.querySelectorAll('.start-timer');
            startButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const duration = parseInt(this.getAttribute('data-duration'));
                    startTimer(duration);
                });
            });

            // Stop button functionality
            document.getElementById('stop-timer').addEventListener('click', function () {
                stopTimer();
            });
        });
    </script>
</body>
</html>