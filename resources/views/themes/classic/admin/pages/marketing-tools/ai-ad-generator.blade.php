@extends('themes.classic.admin.admin_master')
@section('title', 'AI Ad Generator | Premium Refined Luxury Homes')
@section('content')
    <style>
        /* General styling for cards and sections */
        .info-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .info-card h5 {
            color: #333;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .info-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #91d20a; /* Primary color for values */
        }
        .info-card .description {
            color: #666;
            font-size: 0.9rem;
        }

        /* Table styling (reused from other pages) */
        .custom-table-container {
            border-radius: 10px;
            padding: 1.5rem;
        }

        .table thead th {
            background: #e5f5c7;
            color: #333;
            font-weight: 600;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .action-btns {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        /* Custom style for status badges */
        .status-badge {
            font-size: 0.95rem; /* Make font bigger */
            padding: 0.4em 0.8em; /* Increase padding */
            border-radius: 0.5rem; /* Slightly more rounded corners */
            font-weight: bold;
            color: #fff; /* Ensure white text for visibility on colored backgrounds */
        }
        .status-badge.badge-success {
            background-color: #28a745; /* Standard Bootstrap success green */
        }
        .status-badge.badge-warning {
            background-color: #ffc107; /* Standard Bootstrap warning yellow */
            color: #212529; /* Dark text for yellow background */
        }
        .status-badge.badge-danger {
            background-color: #dc3545; /* Standard Bootstrap danger red */
        }
        .status-badge.badge-info {
            background-color: #17a2b8; /* Standard Bootstrap info blue */
        }
        .status-badge.badge-primary {
            background-color: #007bff;
        }
        .status-badge.badge-dark {
            background-color: #343a40;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        @media (max-width: 576px) {
            .table {
                font-size: 0.85rem;
            }

            .action-btns {
                flex-wrap: nowrap;
                gap: 0.15rem;
            }
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #91d20a !important;
            color: #fff !important;
            border: 1px solid #91d20a !important;
        }

        .dataTables_paginate .paginate_button {
            background-color: #f6faeb !important;
            color: #333 !important;
            border-color: #f6faeb !important;
            border-radius: 20px !important;
            margin: 0 2px;
        }

        .dataTables_paginate .paginate_button:hover:not(.current) {
            background-color: #e5f5c7 !important;
            color: #333 !important;
        }
    </style>

    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">AI Ad Generator</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Marketing Tools</li>
                                <li class="breadcrumb-item active" aria-current="page">AI Ad Generator</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row" x-data="aiAdGeneratorData()">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">AI Ad Dashboard & Generation</h4>
                        </div>
                        <div class="box-body">
                            <!-- Overview Cards -->
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="info-card text-center">
                                        <h5>Total Ads Generated</h5>
                                        <div class="value" x-text="totalAds"></div>
                                        <div class="description">Ads created by AI</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="info-card text-center">
                                        <h5>Total Ad Views</h5>
                                        <div class="value" x-text="totalViews.toLocaleString()"></div>
                                        <div class="description">Cumulative views across all ads</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="info-card text-center">
                                        <h5>Average CTR</h5>
                                        <div class="value" x-text="averageCTR + '%'"></div>
                                        <div class="description">Click-Through Rate</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="info-card text-center">
                                        <h5>Leads Generated (AI Ads)</h5>
                                        <div class="value" x-text="leadsFromAIAds"></div>
                                        <div class="description">New leads from AI-generated ads</div>
                                    </div>
                                </div>
                            </div>

                            <!-- AI Ad Generation Form -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Generate New Ad with AI</h5>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="generateAd()" :class="{ 'loading': isLoading }">
                                        <div class="form-group">
                                            <label for="propertyDescription">Property Description / Key Features *</label>
                                            <textarea class="form-control" id="propertyDescription" rows="3" x-model="adFormData.propertyDescription" placeholder="e.g., Spacious 3-bedroom house with garden in city center, near schools and parks." required></textarea>
                                            <div x-show="errors.propertyDescription" class="text-danger mt-1" x-text="errors.propertyDescription"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="targetAudience">Target Audience (optional)</label>
                                            <input type="text" class="form-control" id="targetAudience" x-model="adFormData.targetAudience" placeholder="e.g., First-time homebuyers, Families with children, Investors">
                                        </div>
                                        <div class="form-group">
                                            <label for="adType">Desired Ad Type</label>
                                            <select class="form-control" id="adType" x-model="adFormData.adType">
                                                <option value="Facebook">Facebook Ad</option>
                                                <option value="Instagram">Instagram Ad</option>
                                                <option value="GoogleSearch">Google Search Ad</option>
                                                <option value="Email">Email Campaign</option>
                                                <option value="Brochure">Brochure Copy</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tone">Tone of Voice</label>
                                            <select class="form-control" id="tone" x-model="adFormData.tone">
                                                <option value="Professional">Professional</option>
                                                <option value="Friendly">Friendly</option>
                                                <option value="Luxury">Luxury</option>
                                                <option value="Urgent">Urgent</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-3" :disabled="isLoading">
                                            <i class="fas fa-magic" :class="{ 'fa-spinner fa-spin': isLoading }"></i>
                                            <span x-text="isLoading ? 'Generating...' : 'Generate Ad'"></span>
                                        </button>
                                    </form>
                                    <div x-show="generatedAdContent" class="mt-4 p-3 border rounded bg-light">
                                        <h6>Generated Ad Content:</h6>
                                        <pre x-text="generatedAdContent" class="mb-0"></pre>
                                    </div>
                                </div>
                            </div>

                            <!-- Ad Performance Table -->
                            <div class="box-header with-border">
                                <h4 class="box-title">Ad Performance Metrics</h4>
                            </div>
                            <div class="table-responsive custom-table-container">
                                <table id="ad_performance_table" class="table table-bordered table-striped text-sm align-middle mb-0 w-100" style="border-color: #91d20a;">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Ad Title</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Type</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Views</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Clicks</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">CTR</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Conversions</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Date Created</th>
                                            <th class="text-uppercase small text-secondary fw-bold py-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(ad, index) in adPerformance" :key="ad.id">
                                            <tr>
                                                <td x-text="ad.title"></td>
                                                <td x-text="ad.type"></td>
                                                <td x-text="ad.views.toLocaleString()"></td>
                                                <td x-text="ad.clicks.toLocaleString()"></td>
                                                <td x-text="ad.ctr + '%'"></td>
                                                <td x-text="ad.conversions"></td>
                                                <td x-text="formatDate(ad.dateCreated)"></td>
                                                <td>
                                                    <div class="action-btns">
                                                        <button @click="viewAdDetails(ad)" class="btn btn-info btn-sm">View</button>
                                                        <button @click="deleteAd(ad.id)" class="btn btn-danger btn-sm">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Top Performing Ads -->
                            <div class="box-header with-border mt-4">
                                <h4 class="box-title">Top Performing Ads (Most Viewed)</h4>
                            </div>
                            <div class="row">
                                <template x-for="(ad, index) in topAds" :key="ad.id">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="info-card">
                                            <h6 class="text-primary" x-text="ad.title"></h6>
                                            <p class="mb-1"><strong>Type:</strong> <span x-text="ad.type"></span></p>
                                            <p class="mb-1"><strong>Views:</strong> <span x-text="ad.views.toLocaleString()"></span></p>
                                            <p class="mb-1"><strong>CTR:</strong> <span x-text="ad.ctr + '%'"></span></p>
                                            <p class="mb-0"><strong>Conversions:</strong> <span x-text="ad.conversions"></span></p>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- AI Insights & Recommendations -->
                            <div class="box-header with-border mt-4">
                                <h4 class="box-title">AI Insights & Recommendations</h4>
                            </div>
                            <div class="info-card">
                                <p>Based on current ad performance and market trends, the AI suggests:</p>
                                <ul>
                                    <li><strong>Focus on Video Ads:</strong> Ads with video content show 25% higher engagement.</li>
                                    <li><strong>Target First-Time Buyers:</strong> Properties priced under $300k are generating the most qualified leads.</li>
                                    <li><strong>Optimize for Mobile:</strong> 60% of ad views are from mobile devices; ensure all ad creatives are mobile-responsive.</li>
                                    <li><strong>Experiment with Call-to-Actions:</strong> "Schedule a Tour" is outperforming "Learn More" by 15%.</li>
                                </ul>
                                <p class="text-muted"><i>Last updated: <span x-text="formatDate(new Date().toISOString())"></span></i></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function aiAdGeneratorData() {
            return {
                isLoading: false,
                errors: {},
                totalAds: 150,
                totalViews: 125000,
                averageCTR: 3.5,
                leadsFromAIAds: 85,
                adFormData: {
                    propertyDescription: '',
                    targetAudience: '',
                    adType: 'Facebook',
                    tone: 'Professional'
                },
                generatedAdContent: '',
                adPerformance: [
                    { id: 1, title: 'Luxury Downtown Condo', type: 'Facebook', views: 15000, clicks: 525, ctr: 3.5, conversions: 15, dateCreated: '2025-07-01T10:00:00Z' },
                    { id: 2, title: 'Spacious Family Home', type: 'GoogleSearch', views: 8000, clicks: 320, ctr: 4.0, conversions: 10, dateCreated: '2025-07-05T14:30:00Z' },
                    { id: 3, title: 'Investment Opportunity Duplex', type: 'Instagram', views: 20000, clicks: 600, ctr: 3.0, conversions: 8, dateCreated: '2025-07-08T09:15:00Z' },
                    { id: 4, title: 'Cozy Studio Apartment', type: 'Facebook', views: 7000, clicks: 280, ctr: 4.0, conversions: 20, dateCreated: '2025-07-10T11:45:00Z' },
                    { id: 5, title: 'Waterfront Villa', type: 'Email', views: 5000, clicks: 150, ctr: 3.0, conversions: 5, dateCreated: '2025-07-12T16:00:00Z' }
                ],
                topAds: [], // Will be populated on init

                init() {
                    this.sortTopAds();
                },

                sortTopAds() {
                    this.topAds = [...this.adPerformance].sort((a, b) => b.views - a.views).slice(0, 3);
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    if (isNaN(date.getTime())) return dateString;
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                },

                async generateAd() {
                    this.isLoading = true;
                    this.errors = {};
                    this.generatedAdContent = '';

                    if (!this.adFormData.propertyDescription) {
                        this.errors.propertyDescription = 'Property description is required.';
                        this.isLoading = false;
                        return;
                    }

                    try {
                        // Simulate API call to AI service
                        await new Promise(resolve => setTimeout(resolve, 1500)); // Simulate AI processing time

                        const generatedText = `
Ad Title: Discover Your Dream Home!
Headline: ${this.adFormData.propertyDescription.substring(0, 50)}...
Body: Experience luxury and comfort in this exquisite property. Perfect for ${this.adFormData.targetAudience || 'anyone looking for a new home'}.
Call to Action: Learn More & Schedule a Viewing!
Type: ${this.adFormData.adType}
Tone: ${this.adFormData.tone}
`;
                        this.generatedAdContent = generatedText;

                        // Simulate adding a new ad to performance data
                        const newId = this.adPerformance.length > 0 ? Math.max(...this.adPerformance.map(ad => ad.id)) + 1 : 1;
                        const newAd = {
                            id: newId,
                            title: `AI Generated Ad ${newId}`,
                            type: this.adFormData.adType,
                            views: Math.floor(Math.random() * 5000) + 1000, // Random views
                            clicks: Math.floor(Math.random() * 200) + 50, // Random clicks
                            ctr: (Math.random() * (5 - 2) + 2).toFixed(1), // Random CTR between 2-5%
                            conversions: Math.floor(Math.random() * 10) + 1, // Random conversions
                            dateCreated: new Date().toISOString()
                        };
                        this.adPerformance.unshift(newAd); // Add to top of list
                        this.totalAds++;
                        this.totalViews += newAd.views;
                        this.leadsFromAIAds += newAd.conversions;
                        this.averageCTR = ((this.adPerformance.reduce((sum, ad) => sum + parseFloat(ad.ctr), 0)) / this.adPerformance.length).toFixed(1);

                        this.sortTopAds(); // Re-sort top ads

                        alert('Ad generated successfully!');
                        this.resetAdForm();

                    } catch (error) {
                        console.error('Error generating ad:', error);
                        alert('Error generating ad. Please try again.');
                    } finally {
                        this.isLoading = false;
                    }
                },

                resetAdForm() {
                    this.adFormData = {
                        propertyDescription: '',
                        targetAudience: '',
                        adType: 'Facebook',
                        tone: 'Professional'
                    };
                    this.errors = {};
                },

                viewAdDetails(ad) {
                    alert(`Ad Details:\nTitle: ${ad.title}\nType: ${ad.type}\nViews: ${ad.views}\nClicks: ${ad.clicks}\nCTR: ${ad.ctr}%\nConversions: ${ad.conversions}\nCreated: ${this.formatDate(ad.dateCreated)}`);
                },

                async deleteAd(adId) {
                    if (confirm('Are you sure you want to delete this ad?')) {
                        try {
                            // Simulate API call to delete
                            await new Promise(resolve => setTimeout(resolve, 300));

                            const deletedAd = this.adPerformance.find(ad => ad.id === adId);
                            if (deletedAd) {
                                this.totalAds--;
                                this.totalViews -= deletedAd.views;
                                this.leadsFromAIAds -= deletedAd.conversions;
                            }

                            this.adPerformance = this.adPerformance.filter(ad => ad.id !== adId);
                            this.averageCTR = this.adPerformance.length > 0 ? ((this.adPerformance.reduce((sum, ad) => sum + parseFloat(ad.ctr), 0)) / this.adPerformance.length).toFixed(1) : 0;
                            this.sortTopAds(); // Re-sort top ads

                            alert('Ad deleted successfully!');
                        } catch (error) {
                            console.error('Error deleting ad:', error);
                            alert('Error deleting ad. Please try again.');
                        }
                    }
                }
            }
        }
    </script>
@endsection
