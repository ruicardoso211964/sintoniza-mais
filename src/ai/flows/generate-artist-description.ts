'use server';
/**
 * @fileOverview This file defines a Genkit flow for generating artist descriptions.
 *
 * It includes:
 * - generateArtistDescription: The main function to generate the artist description.
 * - GenerateArtistDescriptionInput: The input type for the generateArtistDescription function.
 * - GenerateArtistDescriptionOutput: The output type for the generateArtistDescription function.
 */

import {ai} from '@/ai/ai-instance';
import {z} from 'genkit';

const GenerateArtistDescriptionInputSchema = z.object({
  artistName: z.string().describe('The name of the artist.'),
  musicGenres: z.array(z.string()).describe('The genres of music the artist plays.'),
  artistBio: z.string().describe('A brief biography of the artist.'),
  inspiration: z.string().optional().describe('Optional: Inspirations of the artist, such as other artists, experiences, or places.'),
});
export type GenerateArtistDescriptionInput = z.infer<typeof GenerateArtistDescriptionInputSchema>;

const GenerateArtistDescriptionOutputSchema = z.object({
  artistDescription: z.string().describe('A compelling and unique description of the artist and their music.'),
});
export type GenerateArtistDescriptionOutput = z.infer<typeof GenerateArtistDescriptionOutputSchema>;

export async function generateArtistDescription(input: GenerateArtistDescriptionInput): Promise<GenerateArtistDescriptionOutput> {
  return generateArtistDescriptionFlow(input);
}

const prompt = ai.definePrompt({
  name: 'generateArtistDescriptionPrompt',
  input: {
    schema: z.object({
      artistName: z.string().describe('The name of the artist.'),
      musicGenres: z.array(z.string()).describe('The genres of music the artist plays.'),
      artistBio: z.string().describe('A brief biography of the artist.'),
      inspiration: z.string().optional().describe('Optional: Inspirations of the artist, such as other artists, experiences, or places.'),
    }),
  },
  output: {
    schema: z.object({
      artistDescription: z.string().describe('A compelling and unique description of the artist and their music.'),
    }),
  },
  prompt: `You are a creative copywriter specializing in artist biographies. Based on the information provided, craft a compelling and unique description of the artist that will attract fans and collaborators.

Artist Name: {{{artistName}}}
Music Genres: {{#each musicGenres}}{{{this}}}{{#unless @last}}, {{/unless}}{{/each}}
Artist Bio: {{{artistBio}}}
{{#if inspiration}}
Inspiration: {{{inspiration}}}
{{/if}}

Write a description that captures the essence of the artist's music and artistic style. The description should be concise, engaging, and tailored to appeal to a broad audience.
`,
});

const generateArtistDescriptionFlow = ai.defineFlow<
  typeof GenerateArtistDescriptionInputSchema,
  typeof GenerateArtistDescriptionOutputSchema
>({
  name: 'generateArtistDescriptionFlow',
  inputSchema: GenerateArtistDescriptionInputSchema,
  outputSchema: GenerateArtistDescriptionOutputSchema,
}, async input => {
  const {output} = await prompt(input);
  return output!;
});
