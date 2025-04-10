import React, { useEffect, useState } from 'react';import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import Parser from 'rss-parser';

interface NewsItem {
  title: string;
  description?: string;
  link: string;
  source?: string;
}

const mockNewsData: NewsItem[] = [
  {
    title: 'Notícia Local 1',
    description: 'Descrição breve da notícia local 1.',
    link: '#',
  },

  {
    title: 'Notícia Local 2',
    description: 'Descrição breve da notícia local 2.',
    source: 'Rádio Local B',
  },
  {
    title: 'Notícia Local 3',
    description: 'Descrição breve da notícia local 3.',
    source: 'Rádio Local A',
  },
];

const rssFeeds = [
  'https://radioamparo.pt/rss',
  'https://mundialfm.sapo.pt/feed/',
  'https://radiocaria.pt/feed/',
  'https://www.radiomertola.pt/site/feed/',
  'https://www.radioourique.com/site/feed/',
  'http://radioideias.com.pt/sintralife/feed/',
];

async function fetchNewsFromFeeds(feeds: string[]): Promise<NewsItem[]> {
    const parser = new Parser();
  const allNews: NewsItem[][] = [];
  const feedNames = ['Rádio Amparo', 'Mundial FM', 'Rádio Caria', 'Rádio Mértola', 'Rádio Ourique', 'Rádio Ideias'];

  for (let i = 0; i < feeds.length; i++) {
    const feedUrl = feeds[i];
    const feedName = feedNames[i];
    try {
      const feed = await parser.parseURL(feedUrl);
        console.error(`Error fetching or parsing feed ${feedUrl}:`, error);
      }

    try {
        const feed = await parser.parseURL(feedUrl);
        feed.items.forEach((item) => {
          const newsItem: NewsItem = {
            title: item.title || 'Sem título',
            description: item.contentSnippet || item.content || 'Sem descrição',
            link: item.link || '#',
            source: feedName,
          };
          if (item.pubDate) {
            newsItem.date = item.pubDate;
          }
          newsFromThisFeed.push(newsItem);
        });
    } catch (error) {
        console.error(`Erro ao buscar ou analisar o feed ${feedUrl}:`, error);
      }
      allNews.push(newsFromThisFeed);
  }


  return allNews;
}



const NewsAggregator: React.FC = () => {
  const [newsData, setNewsData] = useState<NewsItem[]>([]);


  useEffect(() => {
    fetchNewsFromFeeds(rssFeeds).then((news: any) => {
      setNewsData(news);
    });
  }, []);

  return (
    <section className="container mx-auto mt-8">
      <div className="mb-6 px-4"> 
        <h2 className="text-3xl font-bold text-gray-800">Notícias Locais</h2>
      </div>

      <div className="grid grid-cols-1 gap-6 px-4 md:grid-cols-2 lg:grid-cols-3">
        {newsData.map((news, index) => (
                <Card key={index} className="shadow-md">
                  <CardHeader>
                    <CardTitle className="text-lg font-semibold">{news.title}</CardTitle>
                  </CardHeader>
                  <CardContent>
                    {news.description && <CardDescription className="text-gray-700">{news.description}</CardDescription>}
                    <a href={news.link} target="_blank" rel="noopener noreferrer" className="text-blue-500 hover:underline">Ler mais</a>
                    {news.source && <p className="text-gray-500 text-sm mt-2">Fonte: {news.source}</p>}
                  </CardContent>
                </Card>
              ))
        ))}
      </div>
    </section>
  );
};

export default NewsAggregator;