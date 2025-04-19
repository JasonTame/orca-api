<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Candidate|null $candidate
 * @property-read \App\Models\CodingChallenge|null $codingChallenge
 * @property-read \App\Models\InterviewStage|null $currentStage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\Models\JobOpening|null $jobOpening
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application query()
 */
	class Application extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $location
 * @property string|null $resume_url
 * @property string|null $portfolio_url
 * @property string|null $linkedin_url
 * @property int|null $years_experience
 * @property string|null $current_position
 * @property string|null $current_company
 * @property numeric|null $desired_salary
 * @property string $source
 * @property string|null $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CandidateSkill> $skills
 * @property-read int|null $skills_count
 * @method static \Database\Factories\CandidateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereCurrentCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereCurrentPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereDesiredSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate wherePortfolioUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereResumeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Candidate whereYearsExperience($value)
 */
	class Candidate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Candidate|null $candidate
 * @property-read \App\Models\TechSkill|null $skill
 * @method static \Database\Factories\CandidateSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill query()
 */
	class CandidateSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\JobOpening|null $jobOpening
 * @method static \Database\Factories\CodingChallengeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge query()
 */
	class CodingChallenge extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo_url
 * @property string|null $website
 * @property string|null $industry
 * @property string $size
 * @property string|null $description
 * @property string|null $location
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\CompanyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereLogoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereWebsite($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Application|null $application
 * @property-read \App\Models\User|null $interviewer
 * @property-read \App\Models\InterviewStage|null $stage
 * @method static \Database\Factories\InterviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview query()
 */
	class Interview extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\Models\JobOpening|null $jobOpening
 * @method static \Database\Factories\InterviewStageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage query()
 */
	class InterviewStage extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $company_id
 * @property string $title
 * @property string $description
 * @property string|null $team
 * @property string|null $location
 * @property string $type
 * @property string $level
 * @property numeric|null $salary_min
 * @property numeric|null $salary_max
 * @property string|null $requirements
 * @property string|null $benefits
 * @property int|null $hiring_manager_id
 * @property string $status
 * @property bool $is_remote
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $closing_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CodingChallenge> $codingChallenges
 * @property-read int|null $coding_challenges_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $hiringManager
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InterviewStage> $interviewStages
 * @property-read int|null $interview_stages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobSkill> $jobSkills
 * @property-read int|null $job_skills_count
 * @method static \Database\Factories\JobOpeningFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereHiringManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereIsRemote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereSalaryMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereSalaryMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobOpening whereUpdatedAt($value)
 */
	class JobOpening extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\JobOpening|null $jobOpening
 * @property-read \App\Models\TechSkill|null $skill
 * @method static \Database\Factories\JobSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill query()
 */
	class JobSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CandidateSkill> $candidateSkills
 * @property-read int|null $candidate_skills_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, TechSkill> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobSkill> $jobSkills
 * @property-read int|null $job_skills_count
 * @property-read TechSkill|null $parent
 * @method static \Database\Factories\TechSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill query()
 */
	class TechSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

