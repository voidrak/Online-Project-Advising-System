<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Deadline Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #15803d;
            /* green-700 */
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .highlight {
            font-weight: bold;
            color: #16a34a;
            /* green-500 */
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #16a34a;
            /* green-500 */
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #15803d;
            /* green-700 */
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Project Deadline Notification</h1>

        <p>Dear <span class="highlight">Student/Advisor</span>,</p>

        <p>This is a friendly reminder that the deadline for the project <span
                class="highlight">"{{ $project->project_title }}"</span> is
            approaching.</p>

        <p>You have <span class="highlight">{{ $daysLeft > 0 ? $daysLeft . ' days' : 'Deadline Passed' }}</span> left to
            complete this
            project.</p>

        <p>Please make sure to submit your work on time to ensure successful completion.</p>



        <p>Thank you for your dedication and hard work!</p>

        <div class="footer">
            <p>The Project Advising System</p>
        </div>
    </div>
</body>

</html>
