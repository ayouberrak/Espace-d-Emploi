<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV {{ $user->name }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #fff;
            font-size: 14px;
        }
        .container {
            width: 100%;
            /* Removed height: 100% to prevent blank pages */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            vertical-align: top;
            padding: 20px;
        }
        /* Left Sidebar */
        .left-column {
            width: 32%;
            background-color: #f9f9f9; /* Light gray background to distinguish */
            border-right: 2px solid #ccc;
            padding-top: 40px;
            padding-right: 15px;
            padding-left: 25px;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 30px;
            border: 3px solid #333;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 1px;
            color: #000;
            margin-top: 25px;
            border-bottom: 2px solid #333; /* Visual separator */
            padding-bottom: 5px;
        }
        .contact-info {
            font-size: 13px;
            margin-bottom: 30px;
        }
        .contact-item {
            margin-bottom: 10px;
        }
        .icon {
            display: inline-block;
            margin-right: 5px;
            font-weight: bold;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 8px;
            position: relative;
        }

        /* Right Content */
        .right-column {
            width: 68%;
            padding-top: 40px;
            padding-left: 30px;
            padding-right: 30px;
        }
        .header-name {
            font-size: 32px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            color: #000;
        }
        .header-title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            color: #666;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }
        .profile-summary {
            font-style: italic;
            margin-bottom: 30px;
            font-size: 13px;
            color: #444;
            text-align: justify;
        }
        .main-section-title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #000;
            margin-top: 25px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .experience-item {
            margin-bottom: 25px;
        }
        .job-title {
            font-weight: bold;
            font-size: 15px;
            color: #000;
        }
        .company-date {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
            font-style: italic;
            text-transform: uppercase;
        }
        .job-description {
            font-size: 13px;
            color: #333;
            white-space: pre-line; /* Respect line breaks in description */
        }
        
        .skill-tag {
            display: inline-block;
            background: #eee;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <table class="container">
        <tr>
            <!-- Left Sidebar -->
            <td class="left-column">
                <!-- Photo -->
                @if($user->photo)
                    <img src="{{ public_path('storage/' . $user->photo) }}" alt="Photo" class="profile-photo">
                @else
                    <div style="width: 150px; height: 150px; background: #ddd; border-radius: 50%; margin: 0 auto 30px auto; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif

                <!-- Contact -->
                <div class="section-title">CONTACT</div>
                <div class="contact-info">
                    @if($user->profile && $user->profile->phone || $user->phone)
                    <div class="contact-item">
                        <span class="icon"></span> {{ $user->profile->phone ?? $user->phone }}
                    </div>
                    @endif
                    <div class="contact-item">
                        <span class="icon"></span> {{ $user->email }}
                    </div>
                    <div class="contact-item">
                        <span class="icon"></span> Maroc
                    </div>
                </div>

                <!-- Skills (Sidebar style) -->
                @if($user->profile && $user->profile->skills && is_array($user->profile->skills) && count($user->profile->skills) > 0)
                <div class="section-title">COMPÉTENCES</div>
                <ul>
                    @foreach($user->profile->skills as $skill)
                        <li>• {{ $skill }}</li>
                    @endforeach
                </ul>
                @endif

            </td>

            <!-- Right Content -->
            <td class="right-column">
                <div class="header-name">{{ $user->name }}</div>
                <div class="header-title">{{ $user->profile->title ?? 'Développeur' }}</div>

                @if($user->profile && $user->profile->bio)
                <div class="profile-summary">
                    {{ $user->profile->bio }}
                </div>
                @endif

                <!-- Expériences -->
                @if($user->profile && $user->profile->experiances && count($user->profile->experiances) > 0)
                <div class="main-section-title">EXPÉRIENCE PROFESSIONNELLE</div>
                    @foreach($user->profile->experiances as $exp)
                        <div class="experience-item">
                            <div class="job-title">{{ $exp['role'] ?? $exp['title'] ?? 'Poste' }}</div>
                            <div class="company-date">
                                {{ $exp['company'] ?? 'Entreprise' }} | {{ $exp['duration'] ?? $exp['start_date'] . ' - ' . ($exp['end_date'] ?? 'Present') }}
                            </div>
                            <div class="job-description">
                                {{ $exp['description'] ?? '' }}
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Projets -->
                @if($user->profile && $user->profile->projects && count($user->profile->projects) > 0)
                <div class="main-section-title">PROJETS RÉALISÉS</div>
                    @foreach($user->profile->projects as $proj)
                        <div class="experience-item">
                            <div class="job-title">{{ $proj['title'] ?? 'Projet' }} <span style="font-weight:normal; font-size: 13px; color: #666;">({{ $proj['category'] ?? '' }})</span></div>
                            <!-- Assuming description or details might be in the project object eventually, 
                                 but user model shows title/category/image. -->
                        </div>
                    @endforeach
                @endif
                
                <!-- NOTE: Removed "Formations" hardcoded section as requested. 
                     Only displaying real data from DB. -->

            </td>
        </tr>
    </table>
</body>
</html>
