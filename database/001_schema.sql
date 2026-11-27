-- MaturaKorki — schemat bazy danych (Lab 7/8)
-- Uruchamiany automatycznie przez PostgreSQL w kontenerze przy pierwszym starcie.

CREATE TABLE tutors (
    id              BIGSERIAL PRIMARY KEY,
    name            VARCHAR(120) NOT NULL,
    initials        VARCHAR(4) NOT NULL,
    headline        VARCHAR(160) NOT NULL,
    level           VARCHAR(40) NOT NULL
                    CHECK (level IN ('Podstawa', 'Rozszerzenie', 'Podstawa i rozszerzenie')),
    price           INTEGER NOT NULL CHECK (price > 0),
    rating          NUMERIC(2, 1) NOT NULL DEFAULT 0 CHECK (rating BETWEEN 0 AND 5),
    reviews_count   INTEGER NOT NULL DEFAULT 0 CHECK (reviews_count >= 0),
    lessons_count   INTEGER NOT NULL DEFAULT 0 CHECK (lessons_count >= 0),
    experience_years INTEGER NOT NULL DEFAULT 0 CHECK (experience_years >= 0),
    next_slot       VARCHAR(40) NOT NULL DEFAULT '',
    bio             TEXT NOT NULL,
    education       VARCHAR(255) NOT NULL,
    status          VARCHAR(20) NOT NULL DEFAULT 'active'
                    CHECK (status IN ('active', 'pending', 'hidden')),
    created_at      TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE topics (
    id   BIGSERIAL PRIMARY KEY,
    name VARCHAR(120) NOT NULL UNIQUE
);

CREATE TABLE tutor_topics (
    tutor_id   BIGINT NOT NULL REFERENCES tutors (id) ON DELETE CASCADE,
    topic_id   BIGINT NOT NULL REFERENCES topics (id) ON DELETE RESTRICT,
    sort_order INTEGER NOT NULL DEFAULT 0,
    PRIMARY KEY (tutor_id, topic_id)
);

CREATE TABLE tutor_slots (
    id          BIGSERIAL PRIMARY KEY,
    tutor_id    BIGINT NOT NULL REFERENCES tutors (id) ON DELETE CASCADE,
    label       VARCHAR(40) NOT NULL,
    sort_order  INTEGER NOT NULL DEFAULT 0,
    is_available BOOLEAN NOT NULL DEFAULT TRUE,
    UNIQUE (tutor_id, label)
);

CREATE TABLE tutor_reviews (
    id               BIGSERIAL PRIMARY KEY,
    tutor_id         BIGINT NOT NULL REFERENCES tutors (id) ON DELETE CASCADE,
    author           VARCHAR(80) NOT NULL,
    rating           NUMERIC(2, 1) NOT NULL CHECK (rating BETWEEN 1 AND 5),
    reviewed_at_label VARCHAR(40) NOT NULL,
    comment          TEXT NOT NULL,
    is_visible       BOOLEAN NOT NULL DEFAULT TRUE,
    sort_order       INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE bookings (
    id           VARCHAR(20) PRIMARY KEY,
    tutor_id     BIGINT NOT NULL REFERENCES tutors (id) ON DELETE RESTRICT,
    topic        VARCHAR(120) NOT NULL,
    price        INTEGER NOT NULL CHECK (price > 0),
    slot         VARCHAR(40) NOT NULL,
    student_name VARCHAR(80) NOT NULL,
    email        VARCHAR(120) NOT NULL,
    note         TEXT NOT NULL DEFAULT '',
    status       VARCHAR(20) NOT NULL DEFAULT 'pending'
                 CHECK (status IN ('pending', 'accepted', 'completed', 'cancelled', 'declined')),
    created_at   TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_tutors_status ON tutors (status);
CREATE INDEX idx_tutor_slots_tutor ON tutor_slots (tutor_id);
CREATE INDEX idx_tutor_reviews_tutor ON tutor_reviews (tutor_id);
CREATE INDEX idx_bookings_tutor ON bookings (tutor_id);
CREATE INDEX idx_bookings_created ON bookings (created_at DESC);

-- Automatyczne ustawianie updated_at przy UPDATE.
CREATE OR REPLACE FUNCTION set_updated_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER tutors_set_updated_at
BEFORE UPDATE ON tutors
FOR EACH ROW
EXECUTE FUNCTION set_updated_at();
