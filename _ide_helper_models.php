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
 * @property int $id
 * @property int $job_opening_id
 * @property int $candidate_id
 * @property string|null $code_sample_url
 * @property string $status
 * @property int|null $current_stage_id
 * @property string|null $rejection_reason
 * @property string|null $notes
 * @property string|null $referral_source
 * @property \Illuminate\Support\Carbon $applied_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Candidate $candidate
 * @property-read \App\Models\CodingChallenge|null $codingChallenge
 * @property-read \App\Models\InterviewStage|null $currentStage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\Models\JobOpening $jobOpening
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereAppliedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCodeSampleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCurrentStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereReferralSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUpdatedAt($value)
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
 * @property int $id
 * @property int $candidate_id
 * @property int $skill_id
 * @property string $proficiency
 * @property int $years_experience
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Candidate $candidate
 * @property-read \App\Models\TechSkill $skill
 * @method static \Database\Factories\CandidateSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CandidateSkill whereYearsExperience($value)
 */
	class CandidateSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $job_opening_id
 * @property string $title
 * @property string $description
 * @property string $instructions
 * @property string $repository_url
 * @property int $time_limit
 * @property string $difficulty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\JobOpening $jobOpening
 * @method static \Database\Factories\CodingChallengeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereRepositoryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereTimeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CodingChallenge whereUpdatedAt($value)
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobOpening> $jobOpenings
 * @property-read int|null $job_openings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyMember> $members
 * @property-read int|null $members_count
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
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $email
 * @property string|null $position
 * @property string|null $department
 * @property string|null $phone
 * @property bool $is_hiring_manager
 * @property bool $is_recruiter
 * @property bool $is_interviewer
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobOpening> $jobOpenings
 * @property-read int|null $job_openings_count
 * @method static \Database\Factories\CompanyMemberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereIsHiringManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereIsInterviewer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereIsRecruiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyMember whereUpdatedAt($value)
 */
	class CompanyMember extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $application_id
 * @property int $stage_id
 * @property int $interviewer_id
 * @property \Illuminate\Support\Carbon $scheduled_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property string|null $location
 * @property string|null $meeting_url
 * @property string $status
 * @property int|null $technical_score
 * @property int|null $cultural_score
 * @property string|null $feedback
 * @property string|null $decision
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Application $application
 * @property-read \App\Models\CompanyMember $interviewer
 * @property-read \App\Models\InterviewStage $stage
 * @method static \Database\Factories\InterviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereCulturalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereDecision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereInterviewerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereMeetingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereTechnicalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Interview whereUpdatedAt($value)
 */
	class Interview extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $job_opening_id
 * @property string $name
 * @property string|null $description
 * @property int $sequence
 * @property int $duration
 * @property string $format
 * @property bool $is_technical
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Interview> $interviews
 * @property-read int|null $interviews_count
 * @property-read \App\Models\JobOpening $jobOpening
 * @method static \Database\Factories\InterviewStageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereIsTechnical($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InterviewStage whereUpdatedAt($value)
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
 * @property-read \App\Models\CompanyMember|null $hiringManager
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
 * @property int $id
 * @property int $job_opening_id
 * @property int $skill_id
 * @property bool $is_required
 * @property string $importance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JobOpening $jobOpening
 * @property-read \App\Models\TechSkill $skill
 * @method static \Database\Factories\JobSkillFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereImportance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereJobOpeningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobSkill whereUpdatedAt($value)
 */
	class JobSkill extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $category
 * @property bool $is_language
 * @property bool $is_framework
 * @property bool $is_tool
 * @property int|null $parent_skill_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereIsFramework($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereIsLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereIsTool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereParentSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TechSkill whereUpdatedAt($value)
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

