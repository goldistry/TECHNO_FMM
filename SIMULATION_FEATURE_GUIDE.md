# 🎯 Interactive Decision-Making Simulation Feature

## 📋 **Overview**

The Interactive Decision-Making Simulation is a comprehensive feature that helps students validate their major recommendations through scenario-based testing. This feature is **completely dynamic** and generates questions based on the AI's actual recommendations, not hardcoded data.

## 🚀 **Key Features**

### **✅ Dynamic Content Generation**
- Extracts majors from AI response automatically
- Generates scenarios based on identified majors
- Creates personalized questions for each major
- Adapts to any AI recommendation output

### **✅ Progressive Disclosure UI**
- Phase 1: Post-AI recommendation prompt
- Phase 2: Initial scenario questions
- Phase 3: Major confirmation with explanation
- Phase 4: Deep simulation for selected major
- Phase 5: Comprehensive reflective analysis

### **✅ Intelligent Analysis**
- Compatibility scoring based on responses
- Strength and challenge identification
- Honest assessment with recommendations
- Reflective questions for deeper thinking

## 🔄 **Simulation Flow**

### **Phase 1: Post-AI Recommendation Prompt**
After AI provides major recommendations, the system automatically:
1. Extracts majors from AI response using pattern matching
2. Shows simulation prompt with identified majors
3. Offers two options: "Ya, saya ingin mencoba simulasi" or "Tidak, terima kasih"

### **Phase 2: Initial Scenario Questions**
If user selects "Yes":
1. Generates 3 scenario-based questions dynamically
2. Each question tests different aspects (project preference, work environment, problem-solving)
3. Options are mapped to the extracted majors
4. Progress tracking with visual indicators

### **Phase 3: Explanation and Confirmation**
After initial questions:
1. Analyzes responses to determine best matching major
2. Provides detailed explanation of why the major fits
3. Asks for confirmation to continue with deep simulation
4. Option to reconsider or proceed

### **Phase 4: Deep Simulation**
If confirmed:
1. Generates 4-5 major-specific questions
2. Tests practical thinking and problem-solving style
3. Evaluates career preferences and mindset
4. Realistic scenarios specific to the chosen field

### **Phase 5: Reflective Analysis**
Final comprehensive feedback:
1. Compatibility score (0-100%)
2. Identified strengths and potential challenges
3. Honest assessment of major suitability
4. Thought-provoking reflection questions

## 🛠 **Technical Implementation**

### **Database Structure**
```sql
-- Simulation sessions table
CREATE TABLE simulation_sessions (
    id BIGINT PRIMARY KEY,
    user_id BIGINT,
    session_id VARCHAR UNIQUE,
    ai_recommendations JSON,        -- Dynamic majors from AI
    user_answers JSON,             -- Original category answers
    simulation_questions JSON,     -- Generated questions
    user_responses JSON,           -- Simulation answers
    selected_major VARCHAR,        -- Chosen major
    analysis_result JSON,          -- Final analysis
    phase ENUM(...),              -- Current phase
    current_question INT,         -- Progress tracking
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### **Backend Components**

**1. SimulationService.php**
- `extractMajorsFromAI()`: Dynamically extracts majors from AI response
- `generateInitialQuestions()`: Creates scenario questions based on majors
- `generateDeepQuestions()`: Creates major-specific deep questions
- `analyzeResults()`: Provides comprehensive analysis

**2. SimulationController.php**
- `startSimulation()`: Initiates simulation session
- `respondToPrompt()`: Handles user prompt response
- `submitAnswer()`: Processes question answers
- `confirmMajor()`: Handles major confirmation
- `completeSimulation()`: Provides final analysis

**3. Routes**
```php
Route::prefix('simulation')->group(function () {
    Route::post('/start', [SimulationController::class, 'startSimulation']);
    Route::post('/prompt-response', [SimulationController::class, 'respondToPrompt']);
    Route::post('/submit-answer', [SimulationController::class, 'submitAnswer']);
    Route::post('/confirm-major', [SimulationController::class, 'confirmMajor']);
    Route::post('/complete', [SimulationController::class, 'completeSimulation']);
});
```

### **Frontend Components**

**1. Modal Interface**
- Responsive modal with backdrop blur
- Progress bar with percentage tracking
- Smooth transitions between phases
- Mobile-optimized design

**2. JavaScript Functions**
- `showSimulationPrompt()`: Displays initial prompt
- `startSimulation()`: Initiates simulation process
- `respondToPrompt()`: Handles prompt responses
- `showQuestion()`: Displays individual questions
- `submitAnswer()`: Submits answers and handles flow
- `showConfirmation()`: Shows major confirmation
- `updateProgress()`: Updates progress indicators

## 🎨 **Dynamic Question Generation**

### **Major Extraction Patterns**
```javascript
const patterns = [
    '/(?:jurusan|program studi|prodi)\s*:?\s*([^<\n]+)/i',
    '/<strong>\s*\d+\.\s*([^<]+)<\/strong>/i',
    '/\d+\.\s*([A-Za-z\s]+)(?:<br|<\/)/i',
    '/(?:teknik|sistem|manajemen|ekonomi|psikologi)\s+[a-z\s]+/i'
];
```

### **Question Types**

**1. Project Preference Questions**
- Maps different project types to majors
- Tests practical interests and applications
- Example: "Mengembangkan aplikasi mobile" → Teknik Informatika

**2. Work Environment Questions**
- Evaluates preferred working conditions
- Tests personality fit with major requirements
- Example: "Kantor teknologi modern" → Tech majors

**3. Problem-Solving Approach**
- Tests thinking patterns and methodologies
- Evaluates compatibility with major demands
- Example: "Logika dan algoritma" → Programming majors

### **Deep Simulation Questions**

**Tech Majors:**
- Debugging approaches
- Technology preferences
- Learning methodologies
- Project management styles

**Business Majors:**
- Leadership styles
- Decision-making approaches
- Risk tolerance
- Team dynamics

**Psychology/Social:**
- Empathy and listening skills
- Analysis vs. support approaches
- Research interests
- Client interaction preferences

## 📊 **Analysis & Scoring**

### **Compatibility Scoring**
```javascript
function calculateCompatibilityScore(responses, major) {
    let totalScore = 0;
    let maxScore = 0;
    
    responses.forEach(response => {
        totalScore += response.score;
        maxScore += 10; // Max score per question
    });
    
    return (totalScore / maxScore) * 100;
}
```

### **Assessment Levels**
- **80-100%**: "Pilihan sudah sangat tepat!"
- **60-79%**: "Cukup sesuai, ada area yang perlu dipertimbangkan"
- **Below 60%**: "Perlu dipertimbangkan ulang"

### **Reflection Questions**
Dynamic questions based on selected major:
- "Setelah mengetahui hasil simulasi ini, apakah Anda masih yakin dengan pilihan [Major]?"
- "Apa yang paling menarik bagi Anda dari jurusan [Major]?"
- "Bagaimana Anda akan mempersiapkan diri untuk menghadapi tantangan di jurusan ini?"

## 🎯 **User Experience Flow**

### **Complete User Journey**
1. **Complete Categories** → Answer questions in multiple categories
2. **Get AI Recommendation** → Receive overall summary with major recommendations
3. **Simulation Prompt** → Automatic prompt appears after AI summary
4. **Initial Questions** → 3 scenario-based questions to identify best major
5. **Major Confirmation** → Explanation and confirmation for selected major
6. **Deep Simulation** → 4-5 specific questions for chosen major
7. **Final Analysis** → Comprehensive feedback with reflection questions

### **Progressive Disclosure**
- Information revealed step by step
- User can exit at any point
- Clear progress indicators
- Contextual explanations at each phase

## 🔧 **Configuration & Customization**

### **Adding New Major Types**
1. Update `generateTechQuestions()`, `generateBusinessQuestions()`, etc.
2. Add major-specific project descriptions in `getProjectForMajor()`
3. Update scoring logic in analysis functions

### **Customizing Questions**
- Questions are generated dynamically based on extracted majors
- Easy to add new question types in SimulationService
- Scoring can be adjusted per question type

### **Styling Customization**
- Modal uses Tailwind CSS classes
- Progress bar with gradient styling
- Responsive design for all screen sizes
- Consistent with existing chatbot theme

## 🧪 **Testing the Feature**

### **Test Scenario**
1. Complete at least 2 categories in the chatbot
2. Click "Lihat Rekomendasi Jurusan Final"
3. Wait for AI to provide recommendations
4. Simulation prompt should appear automatically
5. Follow the complete simulation flow

### **Expected Behavior**
- Majors extracted from AI response
- Questions generated based on extracted majors
- Smooth transitions between phases
- Progress tracking works correctly
- Final analysis provides meaningful feedback

## 🎉 **Benefits**

### **For Students**
- ✅ Validates AI recommendations through interactive testing
- ✅ Deeper understanding of major requirements
- ✅ Self-reflection and career exploration
- ✅ Confidence in major selection

### **For Educators**
- ✅ Data-driven insights into student preferences
- ✅ Comprehensive assessment beyond traditional methods
- ✅ Personalized guidance for each student
- ✅ Evidence-based major recommendations

The simulation feature provides a comprehensive, interactive way for students to validate their major choices through realistic scenarios and deep self-reflection, all generated dynamically from AI recommendations!
