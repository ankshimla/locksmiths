# garystechhub.ie — SEO & Indexing Submission Checklist

## Search Engines

| # | Platform | URL | Action |
|---|----------|-----|--------|
| 1 | Google Search Console | https://search.google.com/search-console | Add property, verify ownership, submit sitemap: `https://garystechhub.ie/sitemap.xml` |
| 2 | Bing Webmaster Tools | https://www.bing.com/webmasters | Add site, submit sitemap (also covers Yahoo & DuckDuckGo) |
| 3 | Yandex Webmaster | https://webmaster.yandex.com | Add site, submit sitemap |
| 4 | IndexNow | `https://api.indexnow.org/indexnow?url=https://garystechhub.ie&key=YOUR_KEY` | Ping after content updates (Bing Webmaster provides your key) |

## AI Platforms

| # | Platform | Status | Notes |
|---|----------|--------|-------|
| 1 | ChatGPT / OpenAI | GPTBot allowed in robots.txt | Crawls automatically. `llms.txt` and `.well-known/ai-plugin.json` help it understand the site |
| 2 | Perplexity | PerplexityBot allowed in robots.txt | Crawls automatically |
| 3 | Claude / Anthropic | Claude-Web allowed in robots.txt | Crawls automatically |
| 4 | Google Gemini / AI Overviews | Googlebot + Google-Extended allowed | Covered by Google Search Console submission |
| 5 | Apple Intelligence / Siri | Applebot + Applebot-Extended allowed | Submit via https://support.apple.com/applebot |
| 6 | Meta AI | meta-externalagent allowed | Crawls automatically from Facebook/Instagram links |

## Social Media Previews

| # | Platform | Tool URL | Action |
|---|----------|----------|--------|
| 1 | Facebook / Instagram | https://developers.facebook.com/tools/debug/ | Paste `https://garystechhub.ie` to debug OG tags |
| 2 | Twitter / X | https://cards-dev.twitter.com/validator | Paste URL to validate cards |
| 3 | LinkedIn | https://www.linkedin.com/post-inspector/ | Paste URL to inspect post preview |

## Google Business Profile

| # | Platform | URL | Action |
|---|----------|-----|--------|
| 1 | Google Business | https://business.google.com | Claim/update listing with same address, phone, and hours. Critical for local "near me" searches |

## Files in This Repo

| File | Purpose |
|------|---------|
| `robots.txt` | Tells search engines and AI crawlers what they can access |
| `llms.txt` | Structured description of the business for LLM/AI crawlers |
| `.well-known/ai-plugin.json` | ChatGPT plugin manifest for site discovery |

## Notes
- Squarespace auto-generates `sitemap.xml` at `https://garystechhub.ie/sitemap.xml`
- All 12 pages have been confirmed fully SEO-tagged
- Upload `robots.txt` and `llms.txt` to the root of your Squarespace site via **Settings > Advanced > Code Injection** or by using Squarespace's file hosting
- The `.well-known/ai-plugin.json` needs to be accessible at `https://garystechhub.ie/.well-known/ai-plugin.json`
