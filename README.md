# Orca API - ATS (Applicant Tracking System)

A Laravel-based API server for managing the recruitment process, built for an OfferZen dev workshop. This API provides endpoints for managing companies, job openings, candidates, applications, interviews, and more.

## Docs

The API docs are hosted at [orca-api.laravel.cloud](https://orca-api.laravel.cloud/docs)

## Features

- Company management
- Job opening creation and management
- Candidate tracking
- Application processing
- Interview scheduling and feedback
- Technical skills management
- Coding challenge management

## Entity diagram

```mermaid
erDiagram
    COMPANIES ||--o{ COMPANY_MEMBERS : "employs"
    COMPANIES ||--o{ JOB_OPENINGS : "posts"
    COMPANIES {
        id integer PK
        name varchar
        logo_url varchar
        website varchar
        industry varchar
        size enum
        description text
        location varchar
        status enum
        created_at timestamp
        updated_at timestamp
    }

    USERS {
        id integer PK
        name varchar
        email varchar
        role enum
        is_admin boolean
        created_at timestamp
        updated_at timestamp
    }
    
    COMPANY_MEMBERS ||--o{ JOB_OPENINGS : "creates/manages"
    COMPANY_MEMBERS ||--o{ INTERVIEWS : "conducts"
    COMPANY_MEMBERS {
        id integer PK
        company_id integer FK
        name varchar
        email varchar
        position varchar
        department varchar
        phone varchar
        is_hiring_manager boolean
        is_recruiter boolean
        is_interviewer boolean
        status enum
        created_at timestamp
        updated_at timestamp
    }
    
    CANDIDATES ||--o{ APPLICATIONS : "submits"
    CANDIDATES ||--o{ CANDIDATE_SKILLS : "has"
    CANDIDATES {
        id integer PK
        first_name varchar
        last_name varchar
        email varchar
        phone varchar
        location varchar
        resume_url varchar
        github_url varchar
        portfolio_url varchar
        linkedin_url varchar
        years_experience integer
        current_position varchar
        current_company varchar
        desired_salary decimal
        source enum
        notes text
        status enum
        created_at timestamp
        updated_at timestamp
    }
    
    JOB_OPENINGS ||--o{ APPLICATIONS : "receives"
    JOB_OPENINGS ||--o{ JOB_OPENING_SKILLS : "requires"
    JOB_OPENINGS ||--o{ INTERVIEW_STAGES : "has"
    JOB_OPENINGS {
        id integer PK
        company_id integer FK
        title varchar
        description text
        team varchar
        location varchar
        type enum
        level enum
        salary_min decimal
        salary_max decimal
        requirements text
        benefits text
        hiring_manager_id integer FK
        status enum
        is_remote boolean
        published_at timestamp
        closing_date timestamp
        created_at timestamp
        updated_at timestamp
    }
    
    TECH_SKILLS ||--o{ JOB_OPENING_SKILLS : "used in"
    TECH_SKILLS ||--o{ CANDIDATE_SKILLS : "possessed by"
    TECH_SKILLS {
        id integer PK
        name varchar
        category enum
        is_language boolean
        is_framework boolean
        is_tool boolean
        parent_skill_id integer FK
        created_at timestamp
        updated_at timestamp
    }
    
    JOB_OPENING_SKILLS {
        id integer PK
        job_opening_id integer FK
        skill_id integer FK
        is_required boolean
        importance enum
        created_at timestamp
        updated_at timestamp
    }
    
    CANDIDATE_SKILLS {
        id integer PK
        candidate_id integer FK
        skill_id integer FK
        proficiency enum
        years_experience integer
        created_at timestamp
        updated_at timestamp
    }
    
    APPLICATIONS ||--o{ INTERVIEWS : "progresses through"
    APPLICATIONS {
        id integer PK
        job_opening_id integer FK
        candidate_id integer FK
        code_sample_url varchar
        status enum
        current_stage_id integer FK
        rejection_reason varchar
        notes text
        referral_source varchar
        applied_at timestamp
        created_at timestamp
        updated_at timestamp
    }
    
    INTERVIEW_STAGES {
        id integer PK
        job_opening_id integer FK
        name varchar
        description text
        sequence integer
        duration integer
        format enum
        is_technical boolean
        created_at timestamp
        updated_at timestamp
    }
    
    INTERVIEWS {
        id integer PK
        application_id integer FK
        stage_id integer FK
        interviewer_id integer FK
        scheduled_at timestamp
        completed_at timestamp
        location varchar
        meeting_url varchar
        status enum
        technical_score integer
        cultural_score integer
        feedback text
        decision enum
        notes text
        created_at timestamp
        updated_at timestamp
    }
    
    CODING_CHALLENGES ||--o{ APPLICATIONS : "completed by"
    CODING_CHALLENGES {
        id integer PK
        job_opening_id integer FK
        title varchar
        description text
        instructions text
        repository_url varchar
        time_limit integer
        difficulty enum
        created_at timestamp
        updated_at timestamp
    }
```

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: React 19 with Inertia.js
- **Database**: SQLite (for development)
- **Authentication**: Bearer Token
- **API Documentation**: Scribe

## Prerequisites

- PHP 8.2 or higher
- Node.js (latest LTS version)
- Composer
- SQLite

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd orca-api
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Create database:
```bash
touch database/database.sqlite
```

7. Run migrations:
```bash
php artisan migrate
```

## Running the Application

### Development Mode

To run the application in development mode with hot reloading:

```bash
composer run dev
```

This will start:
- Laravel development server
- Queue worker
- Log watcher
- Vite development server

### Server-Side Rendering (SSR)

To run with SSR enabled:

```bash
composer run dev:ssr
```

## Authentication

The API uses Bearer Token authentication. To generate a new token:

```bash
php artisan token:generate
```

Use the generated token in your API requests by including it in the Authorization header:

```
Authorization: Bearer your-token-here
```

## API Documentation

API documentation is available at `/docs` when running the application locally.

## Testing

Run the test suite with:

```bash
composer test
```

## Contributing

This is a workshop project for OfferZen. Please follow the workshop guidelines for any contributions.

## License

This project is licensed under the MIT License. 