-- Database Schema for Espace d'Emploi
-- PostgreSQL

-- Enable UUID extension if needed (optional, using Integers as per diagram)
-- CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- 1. Users Table
-- CREATE TYPE user_role AS ENUM ('candidate', 'recruiter', 'admin');

-- CREATE TABLE users (
--     id SERIAL PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     email VARCHAR(255) UNIQUE NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     role user_role NOT NULL,
--     avatar VARCHAR(255),
--     bio TEXT,
--     location VARCHAR(255),
--     phone VARCHAR(50),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- 2. Profiles Table (1-to-1 with Users)
CREATE TABLE profiles (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL UNIQUE,
    title VARCHAR(255),
    resume_url VARCHAR(255),
    website VARCHAR(255),
    github_link VARCHAR(255),
    linkedin_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_profile_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- 3. Companies Table
CREATE TABLE companies (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(255),
    description TEXT,
    website VARCHAR(255),
    location VARCHAR(255),
    industry VARCHAR(255),
    size VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Job Offers Table
CREATE TYPE job_type AS ENUM ('Stage', 'CDI', 'CDD', 'Freelance');

CREATE TABLE job_offers (
    id SERIAL PRIMARY KEY,
    company_id INTEGER NOT NULL,
    recruiter_id INTEGER NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    type job_type NOT NULL,
    location VARCHAR(255),
    salary_range VARCHAR(100),
    duration VARCHAR(100), -- for internships
    is_trending BOOLEAN DEFAULT FALSE,
    deadline TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_offer_company FOREIGN KEY (company_id) REFERENCES companies (id) ON DELETE CASCADE,
    CONSTRAINT fk_offer_recruiter FOREIGN KEY (recruiter_id) REFERENCES users (id) ON DELETE CASCADE
);

-- 5. Applications Table
CREATE TYPE application_status AS ENUM ('pending', 'accepted', 'rejected');

CREATE TABLE applications (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    job_offer_id INTEGER NOT NULL,
    status application_status DEFAULT 'pending',
    cover_letter TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_application_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_application_job FOREIGN KEY (job_offer_id) REFERENCES job_offers (id) ON DELETE CASCADE
);

-- 6. Education Table
CREATE TABLE educations (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    school VARCHAR(255) NOT NULL,
    degree VARCHAR(255) NOT NULL,
    field_of_study VARCHAR(255),
    start_date DATE,
    end_date DATE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_education_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- 7. Experience Table
CREATE TABLE experiences (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    company_name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    start_date DATE,
    end_date DATE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_experience_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- 8. Projects Table
CREATE TABLE projects (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    link VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_project_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

-- 9. Skills Table
CREATE TABLE skills (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pivot Table: User Skills
CREATE TABLE user_skills (
    user_id INTEGER NOT NULL,
    skill_id INTEGER NOT NULL,
    PRIMARY KEY (user_id, skill_id),
    CONSTRAINT fk_us_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_us_skill FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE
);

-- Pivot Table: Job Offer Skills
CREATE TABLE job_offer_skills (
    job_offer_id INTEGER NOT NULL,
    skill_id INTEGER NOT NULL,
    PRIMARY KEY (job_offer_id, skill_id),
    CONSTRAINT fk_jos_job FOREIGN KEY (job_offer_id) REFERENCES job_offers (id) ON DELETE CASCADE,
    CONSTRAINT fk_jos_skill FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE
);

-- 10. Network Connections Table
CREATE TYPE connection_status AS ENUM ('pending', 'accepted');

CREATE TABLE network_connections (
    id SERIAL PRIMARY KEY,
    requester_id INTEGER NOT NULL,
    recipient_id INTEGER NOT NULL,
    status connection_status DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_nc_requester FOREIGN KEY (requester_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_nc_recipient FOREIGN KEY (recipient_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT chk_different_users CHECK (requester_id <> recipient_id)
);

-- 11. Messages Table
CREATE TABLE messages (
    id SERIAL PRIMARY KEY,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    content TEXT NOT NULL,
    read_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_msg_sender FOREIGN KEY (sender_id) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_msg_receiver FOREIGN KEY (receiver_id) REFERENCES users (id) ON DELETE CASCADE
);

-- Indexes for performance (Optional but recommended)
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_job_offers_company ON job_offers(company_id);
CREATE INDEX idx_applications_user ON applications(user_id);
CREATE INDEX idx_applications_job ON applications(job_offer_id);
    